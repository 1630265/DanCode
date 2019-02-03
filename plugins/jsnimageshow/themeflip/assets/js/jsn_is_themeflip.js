/**
 * @version    $Id: jquery.imageshow.js 16583 2012-10-01 11:10:07Z giangth $
 * @package    JSN.ImageShow
 * @author     JoomlaShine Team <support@joomlashine.com>
 * @copyright  Copyright (C) @JOOMLASHINECOPYRIGHTYEAR@ JoomlaShine.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 *
 */
(function($){
    $.extend({
        JSNISThemeFlip: {

            ops:{},

            initialize : function (options)
            {
                $.extend(options, $.JSNISThemeFlip.ops);
            },
            trim: function(str, chars)
            {
                var self =  $.JSNISThemeFlip;
                return self.ltrim(self.rtrim(str, chars), chars);
            },

            ltrim: function(str, chars)
            {
                chars = chars || "\\s";
                return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
            },

            rtrim: function(str, chars)
            {
                chars = chars || "\\s";
                return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
            },
            parserCss: function(str)
            {
                var self 	=  $.JSNISThemeFlip;
                objCss 		= {};
                var css 	= str.split(';');
                var length 	= css.length;
                var index  	= 0;
                for (var i 	= 0; i < length; i++)
                {
                    var value = css[i].replace(/(\r\n|\n|\r)/gm,"");
                    if (value != '')
                    {
                        var tmpCss = value.split(':');
                        objCss [self.trim(tmpCss[0], " ")] = self.trim(tmpCss[1], " ");
                        index++;
                    }
                }

                return objCss;
            },
            visual: function() {

                this.addEvent2AllVisualElements('containerPanel');
                this.addEvent2AllVisualElements('imagePanel');
                this.addEvent2AllVisualElements('captionPanel');
            },
            addEvent2AllVisualElements: function(elementClass)
            {

                var self = $.JSNISThemeFlip;
                $('.' + elementClass).each(function(index, element)
                {
                    var el 		= $(element);
                    var event 	= 'change';

                    if (el.attr('type') != undefined && el.attr('type') == 'radio') event = 'click';

                    el.unbind(event).bind(event, function()
                    {
                        self.changeValueVisualElement(elementClass, element);
                    });

                    self.changeValueVisualElement(elementClass, element);

                });
            },

            changeValueVisualElement: function(panel, element)
            {
                var self = $.JSNISThemeFlip;
                var el = $(element);
                var name = el.attr('name');

                if (el.attr('type') != undefined && el.attr('type') == 'radio')
                {
                    if(el.attr("checked") != undefined && el.attr("checked") == 'checked')
                    {
                        var value = el.val();
                    }
                }
                else
                {
                    var value = el.val();
                }

                var obj = {name : name, value : value};
                self.changeVisualThumbnail(obj);
            },
            changeVisualThumbnail: function(obj) {
                var name				= obj.name;
                var value				= obj.value;
                var page                = $('.jsn-flip-preview-page');
                var leftPage            = $('.jsn-flip-preview-ls');
                var rightPage           = $('.jsn-flip-preview-rs');
                var title               = $('.jsn-flip-preview-title');
                var titleA               = $('.jsn-flip-preview-title a');
                var description         = $('.jsn-flip-preview-description');
                var caption             = $('.jsn-flip-preview-content');
                var pageNumber          = $('.jsn-flip-preview-page-number');
                var leftPageNumber      = $('.jsn-flip-preview-ls .jsn-flip-preview-page-number');
                var rightPageNumber     = $('.jsn-flip-preview-rs .jsn-flip-preview-page-number');
                var lorem_ipsum         = $('#lorem_ipsum');
                if(name == 'background_color')
                {
                    leftPage.css('background-color', value);
                    leftPageNumber.css('background-color', value);
                }
                if(name == 'background_color_right')
                {
                    rightPage.css('background-color', value);
                    rightPageNumber.css('background-color', value);
                }
                if(name == 'img_layout')
                {
                    page.css('background-size', value);
                }
                if(name == 'container_transparent_background')
                {
                    if(value == 'yes')
                    {
                        leftPage.css('background-color', "transparent");
                        leftPageNumber.css('background-color', "#CCC");
                    }
                    if(value == 'no')
                    {
                        leftPage.css('background-color', $('#background_color').val());
                        leftPageNumber.css('background-color',  $('#background_color').val());
                    }
                }
                if(name == 'container_transparent_background_right')
                {
                    if(value == 'yes')
                    {
                        rightPage.css('background-color', "transparent");
                        rightPageNumber.css('background-color', "#CCC");
                    }
                    if(value == 'no')
                    {
                        rightPage.css('background-color', $('#background_color_right').val());
                        rightPageNumber.css('background-color', $('#background_color_right').val());
                    }
                }
                if(name == 'show_title')
                {
                    if(value == 'no')
                    {
                        title.css('display', 'none');
                    }
                    if(value == 'yes')
                    {
                        title.css('display', 'block');
                    }
                }
                if(name == 'caption_show_description')
                {
                    if(value == 'no')
                    {
                        description.css('display', 'none');
                    }
                    if(value == 'yes')
                    {
                        description.css('display', 'block');
                    }
                }
                if(name == 'title_css')
                {
                    var objCsstitle = this.parserCss(value);
                    titleA.css(objCsstitle);
                }
                if(name == 'description_css')
                {
                    var objCssDesc = this.parserCss(value);
                    description.css(objCssDesc);
                }
                if(name == 'caption_css')
                {
                    var objCssCaption = this.parserCss(value);
                    caption.css(objCssCaption);
                }
                if(name == 'apply_link_title')
                {
                    if(value == 'no')
                    {
                        titleA.css({'cursor':'default', 'text-decoration':'none'});
                    }
                    if(value == 'yes')
                    {
                        titleA.css({'cursor':'pointer'});
                    }

                }
                if(name == 'show_page_number')
                {
                    if(value == 'no')
                    {
                        pageNumber.css('display', 'none');
                    }
                    if(value == 'yes')
                    {
                        pageNumber.css('display', 'block');
                    }
                }
                if(name == 'padding')
                {
                    page.css({width:300-value*2, height: 400-value*2, margin: value+'px'});
                }
                if(name == 'description_limit')
                {
                    var self =  $.JSNISThemeFlip;
                    if(value == 0)
                    {
                        description.text(lorem_ipsum.text());
                    } else
                    {
                        description.text(self.trimWords(lorem_ipsum.text(), value));
                    }
                }
            },
            toogleTab: function(index)
            {
                var el = $('#jsn-is-themeflip');
                el.tabs({'selected':index});
            },
            trimWords: function(theString, numWords)
            {
                expString = theString.split(/\s+/,numWords);
                theNewString=expString.join(" ");
                return theNewString+'...';
            }
        }
    });
})(jsnThemeFlipjQuery);