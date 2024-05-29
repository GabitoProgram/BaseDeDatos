create table persona(
	ci number not null enable,
	paterno varchar2(20),
	nombre varchar2(20),
	CONSTRAINT  persona_PK PRIMARY KEY(ci) ENABLE
)

create table alumno(
	cia number not null enable,
	fono number,
	reguni number,
	CONSTRAINT alumno_PK PRIMARY KEY(cia) ENABLE
)

create table docente(
	cid number not null,
	espe varchar2(20),
	categoria varchar2(20),
	item number,
	CONSTRAINT docente_PK PRIMARY KEY(cid) ENABLE
)

create table materia(
	codm number not null enable,
	CONSTRAINT materia_PK PRIMARY KEY(codm) enable
)

/* Para llaves foraneas y mas de 1 para llaves primaryas */
create asignar(
	cid number not null enable,
	codm number,
	gestion varchar2(20),
	paralelo varchar2(20),
	CONSTRAINT asignar_PK PRIMARY KEY(cid,gestion,paralelo) ENABLE,
	CONSTRAINT asignar_FK1 FOREIGN KEY(cid),
	REFERENCES docente (cid) ENABLE,
	CONSTRAINT asignar_FK2 FOREIGN KEY(codm),
	REFERENCES materia(codm) ENABLE

)