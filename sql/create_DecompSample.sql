
--drop table DecompSample

create table DecompSample(
	DecompSampleID int identity(1,1),
	PlotID int not null,
	TeabagID int null,
	DeploymentDate date not null,  --yyyy-mm-dd
	DeploymentWeight float not null,
	CollectionDate date not null,  --yyyy-mm-dd
	CollectionWeight float null,
	Comment varchar(2000) null, --quoted string
	GridX int not null,
	GridY int not null,
	ProcessedBy varchar(1000) null, --quoted string
	pkeyLoad int not null --pkey to Load table
	)
GO

alter table DecompSample
add constraint pk_DecompSample_DecompSampleID 
primary key clustered (DecompSampleID)



