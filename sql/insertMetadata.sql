INSERT [dbo].[City] ([CityID], [Name], [Population], [age]) VALUES (1, N'Baltimore', 1000000, 200)
GO
INSERT [dbo].[Habitat] ([HabitatID], [HabitatType], [SiteID], [Description], [PhotoID]) VALUES (1, N'Forest', 1, NULL, NULL)
GO
INSERT [dbo].[Habitat] ([HabitatID], [HabitatType], [SiteID], [Description], [PhotoID]) VALUES (2, N'Grass', 1, NULL, NULL)
GO
INSERT [dbo].[Habitat] ([HabitatID], [HabitatType], [SiteID], [Description], [PhotoID]) VALUES (3, N'Disturbed', 1, NULL, NULL)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (1, 3, N'1014 Springfield', 39.34271667, -76.5994)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (2, 3, N'601 Woodbourne & Ready Ave', 39.35503333, -76.60753333)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (3, 1, N'Evergreen', 39.34751667, -76.62043333)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (4, 3, N'Govans Urban', 39.35261667, -76.61028333)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (5, 3, N'JHU Mound', 39.33068333, -76.62493333)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (6, 2, N'Kathy''s Lawn', 39.34266667, -76.6237)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (7, 2, N'Linkwood baseball field ', 39.34478333, -76.62581667)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (8, 1, N'Olin Forest', 39.32958333, -76.62445)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (9, 1, N'Springfield Woods', 39.34206667, -76.60105)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (10, 2, N'The Alameda and Springfield', 39.34281667, -76.60041667)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (11, 1, N'Wilson Park', 39.344907, -76.600548)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (12, 3, N'Wilson Park vacant', 39.3445, -76.60066667)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (13, 2, N'Woman in stained wood house', 39.34406667, -76.60131667)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (14, 3, N'JHU Garage', 39.32623333, -76.62201667)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (15, 2, N'JHU Homewood House', 39.33, -76.61888333)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (16, 1, N'Oregon Ridge - Ivy Hill on Ivy Hill Trail', 39.48118333, -76.6888)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (17, 1, N'Oregon Ridge - James Campbell Trail', 39.4825, -76.68276667)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (18, 1, N'Oregon Ridge - Laurel Blue Trail', 39.49086667, -76.69043333)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (19, 1, N'Oregon Ridge - Loggers Trail', 39.48756667, -76.68936667)
GO
INSERT [dbo].[Plot] ([PlotID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (20, 1, N'Oregon Ridge - Nature Center on Ivy Hill Trail', 39.48513333, -76.68891667)
GO
INSERT [dbo].[Site] ([SiteID], [Name], [siteLat], [siteLon]) VALUES (1, N'Baltimore', 39.2833, -76.6167)
GO
