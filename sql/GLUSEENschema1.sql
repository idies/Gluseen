--========================================================
-- Draft Schema for GLUSEEN database
-- 3/4/2014 
-- Suz Werner
--========================================================


--========================================================
-- "Metadata" tables
--========================================================
----------------------------------------------------------
-- City table 
----------------------------------------------------------

create table City (
	CityID int identity(1,1),
	Name varchar(100),
	Population int,
	age int
);


-----------------------------------------------------------
-- Site table
-----------------------------------------------------------

create table Site (
	SiteID int identity(1,1),
	Name varchar(100),
	CityID int, --FK to City
);


------------------------------------------------------------
-- Habitat
------------------------------------------------------------



create table Habitat(
	HabitatID int identity(1,1) not null,
	HabitatType varchar(30),
	SiteID int not null, --FK to Site
	Description varchar(max),
	PhotoID int --FK to Photo table
);

------------------------------------------------------------
-- Plot
------------------------------------------------------------

create table Plot(
	PlotID int identity(1,1),
	HabitatID int, --FK to Habitat
	lat float,
	long float,
	boundary geometry
);


------------------------------------------------------------
-- Photo
------------------------------------------------------------



create table Photo(
	PhotoID int identity(1,1),
	PhotoPath varchar(1000)
	--probably some other info too, date? name? will this be a common table in the sciserv infastructure?
);

------------------------------------------------------------
-- Video
------------------------------------------------------------
--drop table Video

create table Video(
	VideoID int identity(1,1),
	VideoPath varchar(1000)
	--same questions as Photo table
);


-------------------------------------------------------------
-- Users
-------------------------------------------------------------

--drop table Users

create table Users(
	UserID int identity(1,1),
	Username varchar(100),
	Firstname varchar(100),
	Lastname varchar(100)
	--etc etc etc, will prolly be a common sciserv table
);

--------------------------------------------------------------
-- EarthwormSpecies
--------------------------------------------------------------

create table EarthwormSpecies(
	EarthwormSpeciesID int identity(1,1),
	Name varchar(100),
	Description varchar(max)
);

---------------------------------------------------------------
-- Sensor
---------------------------------------------------------------

create table Sensor(
	SensorID int identity(1,1),
	PlotID int, --FK to Plot
	SensorTypeID int, --FK to SensorType
	Depth float,
	DeploymentDate datetime,
	HardwareID int --FK to Hardware table
)

----------------------------------------------------------------
-- Hardware (this table might not be needed?)
----------------------------------------------------------------

create table Hardware(
	HardwareID int identity(1,1),
	HardwareType varchar(30) --should probably be an enum but just use this for now
);


-----------------------------------------------------------------
-- Sensor Type
-----------------------------------------------------------------

create table SensorType(
	SensorTypeID int identity(1,1),
	Variable varchar(100),
	Units varchar(100),
	description varchar(100)
);





--====================================================================
-- Tables that will contain actual measurement data
--====================================================================

----------------------------------------------------------------------
-- Soil Core
----------------------------------------------------------------------

create table SoilCore(
	SoilCoreID int identity(1,1),
	PlotID int, --FK to Plot
	UserID int, --FK to Users
	Date datetime,
	Depth float,
	Ph float,
	SOM float
);


------------------------------------------------------------------------
-- EarthwormSample
------------------------------------------------------------------------

create table EarthwormSample(
	EarthwormSampleID int identity(1,1),
	PlotID int, --FK to Plot
	UserID int, --FK to Users
	Date datetime,
	Biomass float,
	Density float,
	SpeciesID int,
	SpeciesCount int
);


--------------------------------------------------------------------------
-- MicrobialSample
--------------------------------------------------------------------------

create table MicrobialSample(
	MicrobialSampleID int identity(1,1),
	PlotID int, --FK to Plot
	UserID int, --FK to User
	Date datetime, 
	Depth float,
	Data varchar --actual format of data TK
);



-------------------------------------------------------------------------
-- SensorSample
-------------------------------------------------------------------------



create table SensorSample(
	SensorID int not null, --FK to sensor table
	PlotID int, --FK to plot table
	Timestamp datetime not null,
	Value float
)


-------------------------------------------------------------------------
-- FloraFauna
-------------------------------------------------------------------------

create table FloraFauna(
	FloraFaunaID int identity(1,1),
	PlotID int, --FK to Plot table
	UserID int, -- FK to User table
	Date datetime,
	Notes varchar(max),
	PhotoID int, --FK to Photo table
	VideoID int --FK to Video table
	
)


-------------------------------------------------------------------------
-- Teabag
-------------------------------------------------------------------------

create table DecompSample(
	DecompSampleID int identity(1,1),
	PlotID int not null,
	TeabagID int null,
	DeploymentDate date not null,  --yyyy-mm-dd
	DeploymentWeight decimal(9,3) not null,
	CollectionDate date not null,  --yyyy-mm-dd
	CollectionWeight decimal(9,3) null,
	Comment varchar(2000) null, --quoted string
	GridX int not null,
	GridY int not null,
	ProcessedBy varchar(1000) null, --quoted string
	pkeyLoad int not null --FKey to StateReg.Load table
	)
GO
--=========================================================================
-- Primary Key constraints (will go in IndexMap table eventually
--=========================================================================


alter table City add constraint PK_City primary key clustered (CityID);
alter table Site add constraint PK_Site primary key clustered (SiteID);
alter table Habitat add constraint PK_Habitat primary key clustered (HabitatID, SiteID);
alter table Plot add constraint PK_Plot primary key clustered (PlotID);
alter table Photo add constraint PK_Photo primary key clustered (PhotoID);
alter table Video add constraint PK_Video primary key clustered (VideoID);
alter table Users add constraint PK_Users primary key clustered (UserID);
alter table EarthwormSpecies add constraint PK_EarthwormSpecies primary key clustered (EarthwormSpeciesID);
alter table Sensor add constraint PK_Sensor primary key clustered (SensorID);
alter table Hardware add constraint PK_Hardware primary key clustered (HardwareID);
alter table SensorType add constraint PK_SensorType primary key clustered (SensorTypeID);

alter table DecompSample add constraint PK_DecompSample primary key clustered (DecompSampleID) ;
alter table SoilCore add constraint PK_SoilCore primary key clustered (SoilCoreID)  ;
alter table EarthwormSample add constraint PK_EarthwormSample primary key clustered (EarthwormSampleID) ;
alter table MicrobialSample add constraint PK_MicrobialSample primary key clustered (MicrobialSampleID);
alter table SensorSample add constraint PK_SensorSample  primary key clustered (timestamp, sensorID);
alter table FloraFauna add constraint PK_FloraFauna primary key clustered (FloraFaunaID) ;


--================================================================================
-- Foreign Key constraints (will go in IndexMap table eventually)
--================================================================================

--alter table Site add constraint FK_Site_City foreign key (CityID) references City(CityID);
alter table Habitat add constraint FK_Habitat_Site foreign key (SiteID) references Site(SiteID);
alter table Plot add constraint FK_Plot_Habitat foreign key (HabitatID,SiteID) references Habitat(HabitatID,SiteID);
alter table Sensor add constraint FK_Sensor_Plot foreign key (PlotID) references Plot(PlotID);
alter table Sensor add constraint FK_Sensor_SensorType foreign key (SensorTypeID) references SensorType(SensorTypeID);
alter table Sensor add constraint FK_Sensor_Hardware foreign key (HardwareID) references Hardware(HardwareID);

alter table DecompSample add constraint FK_DecompSample_Plot foreign key (PlotID) references Plot(PlotID);

alter table SoilCore add constraint FK_SoilCore_Plot foreign key (PlotID) references Plot(PlotID);
--alter table SoilCore add constraint FK_SoilCore_User foreign key (UserID) references Users(UserID);
alter table EarthwormSample add constraint FK_EarthwormSample_Plot foreign key (PlotID) references Plot(PlotID);
--alter table EarthwormSample add constraint FK_EarthwormSample_User foreign key (UserID) references Users(UserID);
alter table MicrobialSample add constraint FK_MicrobialSample_Plot foreign key (PlotID) references Plot(PlotID);
--alter table MicrobialSample add constraint FK_MicrobialSample_User foreign key (UserID) references Users(UserID);
alter table SensorSample add constraint FK_SensorSample_Sensor foreign key (SensorID) references Sensor(SensorID);
alter table SensorSample add constraint FK_SensorSample_Plot foreign key (PlotID) references Plot(PlotID);
alter table FloraFauna add constraint FK_FloraFauna_Plot foreign key (PlotID) references Plot(PlotID);
--alter table FloraFauna add constraint FK_FloraFauna_User foreign key (UserID) references Users(UserID);


alter table DecompSample add constraint FK_DecompSample_Load  foreign key(pkeyLoad) references StateReg.Load(pkey)

alter table EarthwormSample add constraint FK_EarthwormSample_EarthwormSpecies
foreign key (SpeciesID) references EarthwormSpecies(EarthwormSpeciesID)



















 


	







	