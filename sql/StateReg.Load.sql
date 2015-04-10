
create table StateReg.Load(

pkey int identity(1,1) not null,  --identity column
LoadStart datetime not null,
LoadEnd datetime not null,

RowsProcessed int not null,     --number of rows in the file
RowsFailed int not null,
LoadStatus varchar(100) not null,	--success or fail, perhaps enumerate some failure modes here? success warning fail 
Error varchar(2000) null,		--put a detailed error message in here
SciDrivePath varchar(100) not null,--some sort of "path" or pointer to the file in SciDrive? I am not sure what this would look like
SciDriveUserID varchar(100) not null, -- some way to identify what user this came from, again not sure what this would look like, or if SciDrive user is the correct concept, but you get the idea
DesinationTable varchar(100) not null --right now it will just be DecompSample but we will need to add more in the future 
)


alter table stateReg.Load
add constraint pkey_Load
primary key clustered (pkey)

--pkeyLoad

----what are we doing about timezones lets talk about this wednesday
