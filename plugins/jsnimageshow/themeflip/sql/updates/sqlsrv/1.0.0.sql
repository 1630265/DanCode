SET QUOTED_IDENTIFIER ON;

IF NOT EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[#__imageshow_theme_flip]') AND type in (N'U'))
BEGIN
CREATE TABLE [#__imageshow_theme_flip](
  [theme_id] [int] IDENTITY(1,1) NOT NULL,
  [show_title] [nvarchar](150) DEFAULT 'yes',
  [caption_show_description] [nvarchar](20) DEFAULT 'yes',
  [apply_link_title] [nvarchar](20) DEFAULT 'yes',
  [open_link_in] [nvarchar](150) DEFAULT 'current_browser',
  [img_layout] [nvarchar](10) DEFAULT 'cover',
  [background_color] [nvarchar](50) DEFAULT '#FFFFFF',
  [background_color_right] [nvarchar](50) DEFAULT '#EEEEEE',
  [container_transparent_background] [nvarchar](20) DEFAULT 'no',
  [container_transparent_background_right] [nvarchar](20) DEFAULT 'no',
  [auto_play] [nvarchar](20) DEFAULT 'no',
  [slide_timing] [nvarchar](20) DEFAULT '3',
  [title_css] [nvarchar](255) DEFAULT '',
  [description_css] [nvarchar](255) DEFAULT '',
  [description_limit] [nvarchar](5) DEFAULT '50',
  [caption_css] [nvarchar](255) DEFAULT '',
  [padding] [nvarchar](20) DEFAULT '10',
  [closed] [nvarchar](20) DEFAULT 'no',
  [show_page_number] [nvarchar](20) DEFAULT 'yes',
  [speed] [nvarchar](20) DEFAULT '500',
 CONSTRAINT [PK_#__imageshow_theme_flip_theme_id] PRIMARY KEY CLUSTERED 
(
	[theme_id] ASC
)WITH (STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF)
)
END;