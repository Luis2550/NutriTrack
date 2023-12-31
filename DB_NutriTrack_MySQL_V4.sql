USE db_nutritrack;

/*==============================================================*/
/* Table: ACTIVIDAD                                             */
/*==============================================================*/
create table actividad
(
   id_actividad         int not null auto_increment,
   ci_paciente			varchar(10) not null,
   actividad            varchar(120),
   descripcion          varchar(800),
   fecha				date,
   primary key (id_actividad)
);

/*==============================================================*/
/* Table: CALENDARIO_CITAS                                      */
/*==============================================================*/
create table calendario_citas
(
   id_calendario_citas  int not null auto_increment,
   ci_nutriologa        varchar(10),
   fecha                date,
   hora_inicio          time,
   hora_fin             time,
   estado               varchar(15) not null CHECK (UPPER(estado) IN ('DISPONIBLE', 'NO DISPONIBLE')),
   ci_paciente          varchar(10) not null,
   primary key (id_calendario_citas)
);

/*==============================================================*/
/* Table: CERTIFICACION                                         */
/*==============================================================*/
create table certificacion
(
   id_certificacion     int not null auto_increment,
   ci_nutriologa        varchar(10) not null,
   titulo               varchar(150),
   archivo              varchar(255),
   primary key (id_certificacion)
);

/*==============================================================*/
/* Table: CITA                                                  */
/*==============================================================*/
create table cita
(
   id_cita              int not null auto_increment,
   ci_paciente          varchar(10),
   ci_nutriologa        varchar(10),
   fecha                date not null,
   hora_inicio          time not null,
   hora_fin             time not null,
   primary key (id_cita)
);

/*==============================================================*/
/* Table: COMIDA                                                */
/*==============================================================*/
create table comida
(
   id_comida            int not null auto_increment,
   comida               varchar(30),
   numero_comidas       smallint CHECK (numero_comidas > 0),
   dia                  varchar(30) CHECK (UPPER(dia) IN ('LUNES', 'MARTES', 'MI�RCOLES', 'JUEVES', 'VIERNES', 'S�BADO', 'DOMINGO')),
   descripcion          varchar(300),
   cantidad_proteina    smallint CHECK (cantidad_proteina > 0),
   cantidad_carbohidratos smallint CHECK (cantidad_carbohidratos > 0),
   cantidad_grasas_saludables char(10) CHECK (cantidad_grasas_saludables > 0),
   primary key (id_comida)
);

/*==============================================================*/
/* Table: CONFIGURACION                                         */
/*==============================================================*/
create table configuracion
(
   id_configuracion     int not null auto_increment,
   ci_nutriologa        varchar(10) not null unique,
   dias_laborales       smallint CHECK (dias_laborales > 0),
   duracion_cita        smallint CHECK (duracion_cita > 0),
   primary key (id_configuracion)
);

/*==============================================================*/
/* Table: DETALLE_COMIDA                                        */
/*==============================================================*/
create table detalle_comida
(
   id_comida            int not null,
   id_plan_nutricional  int not null,
   primary key (id_comida, id_plan_nutricional)
);

/*==============================================================*/
/* Table: ENFERMEDAD_PREVIA                                     */
/*==============================================================*/
create table enfermedad_previa
(
   id_enfermedad_previa int not null auto_increment,
   id_historial_clinico int,
   enfermedad_previa    varchar(100),
   descripcion          varchar(250),
   fecha                date,
   primary key (id_enfermedad_previa)
);

/*==============================================================*/
/* Table: HISTORIAL_CLINICO                                     */
/*==============================================================*/
create table historial_clinico
(
   id_historial_clinico int not null auto_increment,
   ci_paciente           varchar(10) not null unique,
   fecha_creacion       date,
   primary key (id_historial_clinico)
);

/*==============================================================*/
/* Table: HISTORIAL_MEDIDAS                                     */
/*==============================================================*/
create table historial_medidas
(
   id_historial_medidas int not null auto_increment,
   id_historial_clinico int,
   peso int NULL CHECK (peso > 0 AND peso < 10000),  /*libras*/
   estatura int NULL CHECK (estatura > 0 AND estatura < 250),  /*centimetros*/
   presion_arterial_sistolica int NULL CHECK (presion_arterial_sistolica > 0 AND presion_arterial_sistolica < 300),
   presion_arterial_diastolica int NULL CHECK (presion_arterial_diastolica > 0 AND presion_arterial_diastolica < 200),
   fecha                date,
   primary key (id_historial_medidas)
);

/*==============================================================*/
/* Table: HISTORIAL_SUSCRIPCION                                 */
/*==============================================================*/
create table historial_suscripcion
(
   id_suscripcion       int not null,
   ci_paciente          varchar(10) not null,
   fecha_inicio         date,
   fecha_fin            date,
   primary key (id_suscripcion, ci_paciente)
);

/*==============================================================*/
/* Table: HORARIO_LABORAL                                       */
/*==============================================================*/
create table horario_laboral
(
   id_horario_laboral   int not null auto_increment,
   id_configuracion     int not null unique,
   dia_inicio varchar(10) NULL CHECK (UPPER(dia_inicio) IN ('LUNES', 'MARTES', 'MI�RCOLES', 'JUEVES', 'VIERNES', 'S�BADO', 'DOMINGO')),
   dia_fin varchar(10) NULL CHECK (UPPER(dia_fin) IN ('LUNES', 'MARTES', 'MI�RCOLES', 'JUEVES', 'VIERNES', 'S�BADO', 'DOMINGO')),
   descripcion varchar(300) NULL,
   hora_inicio time NULL,
   hora_fin time NULL,
   cantidad_horas_laborales int NULL CHECK (cantidad_horas_laborales > 0),
   primary key (id_horario_laboral)
);

/*==============================================================*/
/* Table: NUTRIOLOGA                                            */
/*==============================================================*/
create table nutriologa
(
   ci_nutriologa        varchar(10) not null,
   cantidad_cupos       int not null CHECK (cantidad_cupos > 0),
   primary key (ci_nutriologa)
);

/*==============================================================*/
/* Table: PACIENTE                                              */
/*==============================================================*/
create table paciente
(
   ci_paciente           varchar(10) not null,
   primary key (ci_paciente)
);

/*==============================================================*/
/* Table: PLAN_NUTRICIONAL                                      */
/*==============================================================*/
create table plan_nutricional
(
   id_plan_nutricional  int not null auto_increment,
   ci_nutriologa        varchar(10),
   ci_paciente          varchar(10) not null,
   fecha_inicio         date,
   fecha_fin            date,
   duracion_dias        smallint,
   primary key (id_plan_nutricional)
);

/*==============================================================*/
/* Table: ROL                                                   */
/*==============================================================*/
create table rol
(
   id_rol               int not null auto_increment,
   rol                  varchar(10) not null  CHECK (UPPER(rol) IN ('PACIENTE', 'NUTRIOLOGA')),
   descripcion          varchar(250),
   primary key (id_rol)
);

/*==============================================================*/
/* Table: SUSCRIPCION                                           */
/*==============================================================*/
create table suscripcion
(
   id_suscripcion       int not null auto_increment,
   suscripcion			varchar(15) NULL CHECK (UPPER(suscripcion) IN ('MENSUAL', 'TRIMESTRAL', 'ANUAL', 'PERSONALIZADO')),
   duracion_dias		int NULL CHECK (duracion_dias >= 0),
   estado				varchar(20) NULL CHECK (UPPER(estado) IN ('SUSCRITO', 'SIN SUSCRIPCI�N')),
   primary key (id_suscripcion)
);

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table usuario
(
   ci_usuario           varchar(10) not null,
   id_rol               int not null,
   nombres              varchar(80),
   apellidos            varchar(80),
   edad                 smallint CHECK (edad > 0 AND edad < 130),
   correo               varchar(60),
   clave                varchar(30),
   sexo                 varchar(9) NOT NULL CHECK (UPPER(sexo) IN ('FEMENINO', 'MASCULINO', 'OTRO')),
   foto                 varchar(255),
   primary key (ci_usuario)
);

alter table actividad add constraint FK_ACTIVIDAD_PACIENTE foreign key (ci_paciente)
      references paciente (ci_paciente) on delete restrict on update restrict;

alter table calendario_citas add constraint FK_CALENDARIO_CITAS_NUTRIOLOGA foreign key (ci_nutriologa)
      references nutriologa (ci_nutriologa) on delete restrict on update restrict;

alter table certificacion add constraint FK_CERTIFICACION_NUTRIOLOGA foreign key (ci_nutriologa)
      references nutriologa (ci_nutriologa) on delete restrict on update restrict;

alter table cita add constraint FK_CITA_PACIENTE foreign key (ci_paciente)
      references paciente (ci_paciente) on delete restrict on update restrict;

alter table configuracion add constraint FK_CONFIGURACION_NUTRIOLOGA foreign key (ci_nutriologa)
      references nutriologa (ci_nutriologa) on delete restrict on update restrict;

alter table detalle_comida add constraint FK_DETALLE_COMIDA_PLAN_NUTRICIONAL foreign key (id_plan_nutricional)
      references plan_nutricional (id_plan_nutricional) on delete restrict on update restrict;

alter table detalle_comida add constraint FK_DETALLE_COMIDA_COMIDA foreign key (id_comida)
      references comida (id_comida) on delete restrict on update restrict;

alter table enfermedad_previa add constraint FK_ENFERMEDAD_PREVIA_HISTORIAL_CLINICO foreign key (id_historial_clinico)
      references historial_clinico (id_historial_clinico) on delete restrict on update restrict;

alter table historial_clinico add constraint FK_HISTORIAL_CLINICO_PACIENTE foreign key (ci_paciente)
      references paciente (ci_paciente) on delete restrict on update restrict;

alter table historial_medidas add constraint FK_HISTORIAL_MEDIDAS_HISTORIAL_CLINICO foreign key (id_historial_clinico)
      references historial_clinico (id_historial_clinico) on delete restrict on update restrict;

alter table historial_suscripcion add constraint FK_HISTORIAL_SUSCRIPCION_PACIENTE foreign key (ci_paciente)
      references paciente (ci_paciente) on delete restrict on update restrict;

alter table historial_suscripcion add constraint FK_HISTORIAL_SUSCRIPCION_SUSCRIPCION foreign key (id_suscripcion)
      references suscripcion (id_suscripcion) on delete restrict on update restrict;

alter table horario_laboral add constraint FK_HORARIO_LABORAL_CONFIGURACION foreign key (id_configuracion)
      references configuracion (id_configuracion) on delete restrict on update restrict;

alter table nutriologa add constraint FK_NUTRIOLOGA_USUARIO foreign key (ci_nutriologa)
      references usuario (ci_usuario) on delete restrict on update restrict;

alter table paciente add constraint FK_CI_PACIENTE_USUARIO foreign key (ci_paciente)
      references usuario (ci_usuario) on delete restrict on update restrict;

alter table plan_nutricional add constraint FK_PLAN_NUTRICIONAL_NUTRIOLOGA foreign key (ci_nutriologa)
      references nutriologa (ci_nutriologa) on delete restrict on update restrict;

alter table usuario add constraint FK_USUARIO_ROL foreign key (id_rol)
      references rol (id_rol) on delete restrict on update restrict;

/*TRIGGERS PARA VERIFICAR CONSISTENCIA EN LOS DATOS*/
/*TRIGER ANTES DE INGRESAR DATOS A LA TABLA PACIENTE*/
DELIMITER //
CREATE TRIGGER before_insert_paciente
BEFORE INSERT ON paciente
FOR EACH ROW
BEGIN
    DECLARE user_role varchar(255);

    -- Obtener el rol del usuario que est� realizando la inserci�n
    SELECT rol INTO user_role FROM rol WHERE id_rol = (SELECT id_rol FROM usuario WHERE ci_usuario = NEW.ci_paciente);

    -- Verificar el rol antes de insertar en paciente
    IF user_role != 'PACIENTE' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Solo los usuarios con rol "PACIENTE" pueden ser insertados en la tabla paciente';
    END IF;
END;
//
DELIMITER ;



/*TRIGER ANTES DE INGRESAR DATOS A LA TABLA NUTRIOLOGA*/
DELIMITER //
CREATE TRIGGER before_insert_nutriologa
BEFORE INSERT ON nutriologa
FOR EACH ROW
BEGIN
    DECLARE user_role varchar(255);

    -- Obtener el rol del usuario que est� realizando la inserci�n
    SELECT rol INTO user_role FROM rol WHERE id_rol = (SELECT id_rol FROM usuario WHERE ci_usuario = NEW.ci_nutriologa);

    -- Verificar el rol antes de insertar en nutriologa
    IF user_role != 'NUTRIOLOGA' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Solo los usuarios con rol "NUTRIOLOGA" pueden ser insertados en la tabla nutriologa';
    END IF;
END;
//
DELIMITER ;