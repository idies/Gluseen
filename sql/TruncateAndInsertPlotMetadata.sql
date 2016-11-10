truncate table city
truncate table habitat
truncate table plot
truncate table site



INSERT [dbo].[City] ([CityID], [Name], [Population], [age]) VALUES (1, N'Baltimore', 622104, 286)
GO
INSERT [dbo].[City] ([CityID], [Name], [Population], [age]) VALUES (2, N'Lahti', 102662, 570)
GO
INSERT [dbo].[City] ([CityID], [Name], [Population], [age]) VALUES (3, N'Helsinki', 599676, 465)
GO
INSERT [dbo].[Habitat] ([HabitatID], [HabitatType], [SiteID], [Description], [PhotoID]) VALUES (1, N'Remnant', 1, NULL, NULL)
GO
INSERT [dbo].[Habitat] ([HabitatID], [HabitatType], [SiteID], [Description], [PhotoID]) VALUES (2, N'Turf', 1, NULL, NULL)
GO
INSERT [dbo].[Habitat] ([HabitatID], [HabitatType], [SiteID], [Description], [PhotoID]) VALUES (3, N'Ruderal', 1, NULL, NULL)
GO
INSERT [dbo].[Habitat] ([HabitatID], [HabitatType], [SiteID], [Description], [PhotoID]) VALUES (4, N'Reference', 1, NULL, NULL)

set identity_insert plot on

GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (1, 1, 3, N'1014 Springfield', 39.34271667, -76.5994)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (2, 1, 3, N'601 Woodbourne & Ready Ave', 39.35503333, -76.60753333)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (3, 1, 1, N'Evergreen', 39.34751667, -76.62043333)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (4, 1, 3, N'Govans Urban', 39.35261667, -76.61028333)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (5, 1, 3, N'JHU Mound', 39.33068333, -76.62493333)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (6, 1, 2, N'Kathy''s Lawn', 39.34266667, -76.6237)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (7, 1, 2, N'Linkwood baseball field ', 39.34478333, -76.62581667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (8, 1, 1, N'Olin Forest', 39.32958333, -76.62445)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (9, 1, 1, N'Springfield Woods', 39.34206667, -76.60105)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (10, 1, 2, N'The Alameda and Springfield', 39.34281667, -76.60041667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (11, 1, 1, N'Wilson Park', 39.344907, -76.600548)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (12, 1, 3, N'Wilson Park vacant', 39.3445, -76.60066667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (13, 1, 2, N'Woman in stained wood house', 39.34406667, -76.60131667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (14, 1, 3, N'JHU Garage', 39.32623333, -76.62201667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (15, 1, 2, N'JHU Homewood House', 39.33, -76.61888333)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (16, 1, 4, N'Oregon Ridge - Ivy Hill on Ivy Hill Trail', 39.48118333, -76.6888)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (17, 1, 4, N'Oregon Ridge - James Campbell Trail', 39.4825, -76.68276667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (18, 1, 4, N'Oregon Ridge - Laurel Blue Trail', 39.49086667, -76.69043333)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (19, 1, 4, N'Oregon Ridge - Loggers Trail', 39.48756667, -76.68936667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (20, 1, 4, N'Oregon Ridge - Nature Center on Ivy Hill Trail', 39.48513333, -76.68891667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (21, 2, 3, N'Lahti ruderal 1', 61.00563056, 25.65590833)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (22, 2, 3, N'Lahti ruderal 2', 60.96986389, 25.65290556)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (23, 2, 3, N'Lahti ruderal 3', 60.99339722, 25.707175)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (24, 2, 3, N'Lahti ruderal 4', 60.99216667, 25.71403333)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (25, 2, 3, N'Lahti ruderal 5', 60.97074722, 25.70374444)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (26, 2, 2, N'Lahti turf 1', 61.00624722, 25.65335)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (27, 2, 2, N'Lahti turf 2', 61.01533611, 25.66536667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (28, 2, 2, N'Lahti turf 3', 60.98553056, 25.65063611)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (29, 2, 2, N'Lahti turf 4', 60.98543056, 25.64503889)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (30, 2, 2, N'Lahti turf 5', 60.97139444, 25.65134722)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (31, 2, 1, N'Lahti remnant 1', 61.01368333, 25.68161944)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (32, 2, 1, N'Lahti remnant 2', 61.00980556, 25.67746389)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (33, 2, 1, N'Lahti remnant 3', 60.96299444, 25.65288889)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (34, 2, 1, N'Lahti remnant 4', 60.99243056, 25.70189444)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (35, 2, 1, N'Lahti remnant 5', 60.96534167, 25.69966667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (36, 2, 4, N'Lahti reference 1', 61.07971944, 25.69931111)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (37, 2, 4, N'Lahti reference 2', 61.09211111, 25.73877778)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (38, 2, 4, N'Lahti reference 3', 61.06161667, 25.66001667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (39, 2, 4, N'Lahti reference 4', 61.06278611, 25.54026111)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (40, 2, 4, N'Lahti reference 5', 60.91585556, 25.55503056)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (41, 3, 3, N'Helsinki ruderal 1', 60.22338333, 25.02272222)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (42, 3, 3, N'Helsinki ruderal 2', 60.19846667, 24.96981944)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (43, 3, 3, N'Helsinki ruderal 3', 60.193975, 24.97747778)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (44, 3, 3, N'Helsinki ruderal 4', 60.18963333, 24.97614444)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (45, 3, 3, N'Helsinki ruderal 5', 60.26724167, 25.01248056)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (46, 3, 2, N'Helsinki turf 1', 60.22748333, 25.01173889)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (47, 3, 2, N'Helsinki turf 2', 60.19838333,24.964875)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (48, 3, 2, N'Helsinki turf 3', 60.16576667, 24.93898056)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (49, 3, 2, N'Helsinki turf 4',	60.17378611, 24.93292778)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (50, 3, 2, N'Helsinki turf 5',	60.19149722, 24.926775)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (51, 3, 1, N'Helsinki remnant 1', 60.20158611,	24.85868611)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (52, 3, 1, N'Helsinki remnant 2', 60.20871111, 24.87694444)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (53, 3, 1, N'Helsinki remnant 3', 60.22093056,	24.92323611)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (54, 3, 1, N'Helsinki remnant 4', 60.22595833, 24.97885278)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (55, 3, 1, N'Helsinki remnant 5', 60.23798611,	24.90382778)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (56, 3, 4, N'Helsinki reference 1', 60.30770278, 24.53240278)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (57, 3, 4, N'Helsinki reference 2', 60.287625,	24.79548056)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (58, 3, 4, N'Helsinki reference 3', 60.25747222, 24.92146667)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (59, 3, 4, N'Helsinki reference 4', 60.29190833, 25.14645)
GO
INSERT [dbo].[Plot] ([PlotID], [SiteID], [HabitatID], [Name], [plotLat], [plotLon]) VALUES (60, 3, 4, N'Helsinki reference 5', 60.24609722, 25.17080556)

set identity_insert plot off

set identity_insert site on
GO
INSERT [dbo].[Site] ([SiteID], [Name], [siteLat], [siteLon]) VALUES (1, N'Baltimore', 39.2833, -76.6167)
GO
INSERT [dbo].[Site] ([SiteID], [Name], [siteLat], [siteLon]) VALUES (2, N'Lahti', 60.9833, 25.65)
GO
INSERT [dbo].[Site] ([SiteID], [Name], [siteLat], [siteLon]) VALUES (3, N'Helsinki', 60.1078, 24.9375)
GO

set identity_insert site off

