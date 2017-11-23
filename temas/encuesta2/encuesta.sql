CREATE TABLE DAW206_DBdepartamentos.Encuesta (
nombreyapellidos varchar(30) NOT NULL PRIMARY KEY ,
dni VARCHAR( 100 ) NOT NULL,
satisfaccion int,
fechanac date,
materiales varchar(100),
opiniones varchar(300),
ip varchar(100) 
) ENGINE = INNODB;
