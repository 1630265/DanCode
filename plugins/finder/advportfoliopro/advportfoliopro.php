<?php
/**
 * @copyright	Copyright (c) 2012 Skyline Software (http://extstore.com). All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die();

jimport('joomla.application.component.helper');

// Load the base adapter.
require_once JPATH_ADMINISTRATOR . '/components/com_finder/helpers/indexer/adapter.php';

/**
 * Finder adapter for Advanced Portfolio Pro Projects
 *
 * @package		Joomla.Plugin
 * @subpakage	Skyline.Advportfoliopro
 */
class plgFinderAdvportfoliopro extends FinderIndexerAdapter {
	/** @var string The plugin identifier. */
	protected $context		= 'Advanced Portfolio Pro';
	/** @var string	The extension name. */
	protected $extension	= 'com_advportfoliopro';
	/** @var string The sublayout to use when rendering the results. */
	protected $layout		= 'project';
	/** @var string	The type of content that the adapter indexes. */
	protected $type_title	= 'Advanced Portfolio Pro - Projects';
	/** @var string	The table name. */
	protected $table		= '#__advportfoliopro_projects';

	/**
	 * Constructor.
	 *
	 * @param 	$subject
	 * @param	array $config
	 */
	function __construct(&$subject, $config = array()) {
		// call parent constructor
		parent::__construct($subject, $config);

		$this->loadLanguage();
	}

	/**
	 * Method to update the item link information when the item category is
	 * changed. This is fired when the item category is published or unpublished
	 * from the list view.
	 *
	 * @param   string   $extension  The extension whose category has been updated.
	 * @param   array    $pks        A list of primary key ids of the content that has changed state.
	 * @param   integer  $value      The value of the state that the content has been changed to.
	 *
	 * @return  void
	 */
	public function onFinderCategoryChangeState($extension, $pks, $value) {
		// Make sure we're handling com_advportfoliopro categories
		if ($extension == $this->extension) {
			$this->categoryStateChange($pks, $value);
		}
	}

	/**
	 * Method to remove the link information for items that have been deleted.
	 *
	 * @param   string  $context  The context of the action being performed.
	 * @param   JTable  $table    A JTable object containing the record to be deleted
	 *
	 * @return  boolean  True on success.
	 * @throws  Exception on database error.
	 */
	public function onFinderAfterDelete($context, $table) {
		if ($context == 'com_advportfoliopro.project') {
			$id = $table->id;
		} elseif ($context == 'com_finder.index') {
			$id = $table->link_id;
		} else {
			return true;
		}

		// Remove the items.
		return $this->remove($id);
	}

	/**
	 * Method to determine if the access level of an item changed.
	 *
	 * @param   string   $context  The context of the content passed to the plugin.
	 * @param   JTable   $row      A JTable object
	 * @param   boolean  $isNew    If the content has just been created
	 *
	 * @return  boolean  True on success.
	 * @throws  Exception on database error.
	 */
	public function onFinderAfterSave($context, $row, $isNew) {
		// We only want to handle projects here. We need to handle front end and back end editing.
		if ($context == 'com_advportfoliopro.project' || $context == 'com_advportfoliopro.form') {
			// Check if the access levels are different
			if (!$isNew && $this->old_access != $row->access) {
				// Process the change.
				$this->itemAccessChange($row);
			}

			// Reindex the item
			$this->reindex($row->id);
		}

		// Check for access changes in the category
		if ($context == 'com_categories.category') {
			// Check if the access levels are different
			if (!$isNew && $this->old_cataccess != $row->access) {
				$this->categoryAccessChange($row);
			}
		}

		return true;
	}

	/**
	 * Method to reindex the link information for an item that has been saved.
	 * This event is fired before the data is actually saved so we are going
	 * to queue the item to be indexed later.
	 *
	 * @param   string   $context  The context of the content passed to the plugin.
	 * @param   JTable   $row     A JTable object
	 * @param   boolean  $isNew    If the content is just about to be created
	 *
	 * @return  boolean  True on success.
	 * @throws  Exception on database error.
	 */
	public function onFinderBeforeSave($context, $row, $isNew) {
		// We only want to handle projects here
		if ($context == 'com_advportfoliopro.project' || $context == 'com_advportfoliopro.form') {
			// Query the database for the old access level if the item isn't new
			if (!$isNew) {
				$this->checkItemAccess($row);
			}
		}

		// Check for access levels from the category
		if ($context == 'com_categories.category') {
			// Query the database for the old access level if the item isn't new
			if (!$isNew) {
				$this->checkCategoryAccess($row);
			}
		}

		return true;
	}

	/**
	 * Method to update the link information for items that have been changed
	 * from outside the edit screen. This is fired when the item is published,
	 * unpublished, archived, or unarchived from the list view.
	 *
	 * @param   string   $context  The context for the content passed to the plugin.
	 * @param   array    $pks      A list of primary key ids of the content that has changed state.
	 * @param   integer  $value    The value of the state that the content has been changed to.
	 *
	 * @return  void
	 */
	public function onFinderChangeState($context, $pks, $value) {
		// We only want to handle projects here
		if ($context == 'com_advportfoliopro.project' || $context == 'com_advportfoliopro.form') {
			$this->itemStateChange($pks, $value);
		}
		// Handle when the plugin is disabled
		if ($context == 'com_plugins.plugin' && $value === 0) {
			$this->pluginDisable($pks);
		}
	}

	/**
	 * Method to index an item. The item must be a FinderIndexerResult object.
	 *
	 * @param   FinderIndexerResult  $item    The item to index as an FinderIndexerResult object.
	 * @param   string               $format  The item format
	 *
	 * @return  void
	 * @throws  Exception on database error.
	 */
	protected function index(FinderIndexerResult $item, $format = 'html') {
		// Check if the extension is enabled
		if (JComponentHelper::isEnabled($this->extension) == false) {
			return;
		}

		// Initialize the item parameters.
		$registry		= new JRegistry;
		$registry->loadString($item->params);
		$item->params	= $registry;

		$registry		= new JRegistry;
		$registry->loadString($item->metadata);
		$item->metadata	= $registry;

		// Build the necessary route and path information.
		$item->url		= $this->getURL($item->id, $this->extension, $this->layout);
		$item->route	= AdvPortfolioProHelperRoute::getProjectRoute($item->slug, $item->catslug);
		$item->path		= FinderIndexerHelper::getContentPath($item->route);

		// Add the meta-author.
		$item->metaauthor = $item->metadata->get('author');

		// Handle the link to the meta-data.
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'link');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metakey');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metadesc');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'metaauthor');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'author');
		$item->addInstruction(FinderIndexer::META_CONTEXT, 'created_by_alias');

		// Add the type taxonomy data.
		$item->addTaxonomy('Type', 'Advanced Portfolio Pro - Projects');

		// Add the category taxonomy data.
		$item->addTaxonomy('Category', $item->category, $item->cat_state, $item->cat_access);

		// Add the language taxonomy data.
		$item->addTaxonomy('Language', $item->language);

		// Get content extras.
		FinderIndexerHelper::getContentExtras($item);

		// Index the item.
        FinderIndexer::index($item);
	}

	/**
	 * Method to setup the indexer to be run.
	 *
	 * @return  boolean  True on success.
	 */
	protected function setup() {
		// Load dependent classes.
		require_once JPATH_SITE . '/components/com_advportfoliopro/helpers/route.php';

		return true;
	}

	/**
	 * Method to get the SQL query used to retrieve the list of content items.
	 *
	 * @param   mixed  $sql  A JDatabaseQuery object or null.
	 *
	 * @return  JDatabaseQuery  A database object.
	 */
	protected function getListQuery($sql = null) {
		$db = JFactory::getDbo();
		// Check if we can use the supplied SQL query.
		$sql = $sql instanceof JDatabaseQuery ? $sql : $db->getQuery(true);
		$sql->select('a.id, a.catid, a.title, a.alias, a.short_description AS summary');
		$sql->select('a.metakey, a.metadesc, a.metadata, a.language, a.access, a.ordering');
		$sql->select('a.created_by_alias, a.modified, a.modified_by');
		$sql->select('a.state AS state, a.ordering, a.access, a.created AS start_date, a.params');
		$sql->select('c.title AS category, c.published AS cat_state, c.access AS cat_access');

		// Handle the alias CASE WHEN portion of the query
		$case_when_item_alias	= ' CASE WHEN ';
		$case_when_item_alias	.= $sql->charLength('a.alias');
		$case_when_item_alias	.= ' THEN ';
		$a_id					= $sql->castAsChar('a.id');
		$case_when_item_alias	.= $sql->concatenate(array($a_id, 'a.alias'), ':');
		$case_when_item_alias	.= ' ELSE ';
		$case_when_item_alias	.= $a_id.' END as slug';
		$sql->select($case_when_item_alias);

		$case_when_category_alias	= ' CASE WHEN ';
		$case_when_category_alias	.= $sql->charLength('c.alias');
		$case_when_category_alias	.= ' THEN ';
		$c_id						= $sql->castAsChar('c.id');
		$case_when_category_alias	.= $sql->concatenate(array($c_id, 'c.alias'), ':');
		$case_when_category_alias	.= ' ELSE ';
		$case_when_category_alias	.= $c_id.' END as catslug';
		$sql->select($case_when_category_alias);

		$sql->from('#__advportfoliopro_projects AS a');
		$sql->join('LEFT', '#__categories AS c ON c.id = a.catid');

		return $sql;
	}

	/**
	 * Method to get the query clause for getting items to update by time.
	 *
	 * @param   string  $time  The modified timestamp.
	 *
	 * @return  JDatabaseQuery  A database object.
	 */
	protected function getUpdateQueryByTime($time) {
		// Build an SQL query based on the modified time.
		$sql = $this->db->getQuery(true);
		$sql->where('a.date >= ' . $this->db->quote($time));

		return $sql;
	}
}

