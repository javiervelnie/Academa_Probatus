/*CREAR ESQUEMA*/
CREATE SCHEMA `academia` ;


/* TABLA ALUMNOS */
CREATE TABLE `academia`.`alumno` (
  `id` INT(4) PRIMARY KEY AUTO_INCREMENT,
  `dni` VARCHAR(9) NOT NULL UNIQUE,
  `nombre` VARCHAR(255) NOT NULL,
  `apellidos` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL UNIQUE,
  `password1` VARCHAR(20) NOT NULL,
  `password2` VARCHAR(20) NOT NULL,
  UNIQUE INDEX `dni_UNIQUE` (`dni` ASC) VISIBLE)
COMMENT = 'Tabla para los usuarios alumnos';

INSERT INTO `academia`.`alumno` (`dni`, `nombre`, `apellidos`, `email`, `password1`, `password2`) VALUES ('12508425J', 'Javier', 'Velazquez Nieto', 'javiervnieto99@gmail.com', 'contraseña1', 'contraseña1');
INSERT INTO `academia`.`alumno` (`dni`, `nombre`, `apellidos`, `email`, `password1`, `password2`) VALUES ('12453204S', 'Emilio', 'Lopez Lage', 'emiliolop1@hotmail.com', 'contraseña1', 'contraseña1');


/* TABLA PROFESORES */
CREATE TABLE `academia`.`profesor` (
  `id` INT(4) PRIMARY KEY AUTO_INCREMENT,
  `dni` VARCHAR(9) NOT NULL UNIQUE,
  `nombre` VARCHAR(255) NOT NULL,
  `apellidos` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL UNIQUE,
  `password1` VARCHAR(20) NOT NULL,
  `password2` VARCHAR(20) NOT NULL,
  UNIQUE INDEX `dni_UNIQUE` (`dni` ASC) VISIBLE)
COMMENT = 'Tabla para los usuarios profesores';

INSERT INTO `academia`.`profesor` (`dni`, `nombre`, `apellidos`, `email`, `password1`, `password2`) VALUES ('12457831K', 'Ana', 'Lopez Sanz', 'analop@probatus.com', 'contraseña1', 'contraseña1');
INSERT INTO `academia`.`profesor` (`dni`, `nombre`, `apellidos`, `email`, `password1`, `password2`) VALUES ('12453204S', 'Evaristo', 'Perez Saez', 'evas@probatus.com', 'admin', 'admin');


/* TABLA TAREAS */
CREATE TABLE `academia`.`tareas` (
  `id` INT AUTO_INCREMENT,
  `asignatura` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `estado` VARCHAR(255) NOT NULL,
  `idalumno` INT NOT NULL,
  `archivo` VARCHAR(100) NULL,
  `fechacreacion` VARCHAR(100) NOT NULL,
  `fechacorreccion` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `FOREIGN_ID_ALUMNO_idx` (`idalumno` ASC) VISIBLE,
  CONSTRAINT `FOREIGN_ID_ALUMNO`
    FOREIGN KEY (`idalumno`)
    REFERENCES `academia`.`alumno` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
    );
