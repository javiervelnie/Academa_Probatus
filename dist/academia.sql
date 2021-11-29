/* TABLA ALUMNOS */
CREATE TABLE `academia`.`alumno` (
  `dni` VARCHAR(9) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `apellidos` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password1` VARCHAR(20) NOT NULL,
  `password2` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`dni`),
  UNIQUE INDEX `dni_UNIQUE` (`dni` ASC) VISIBLE)
COMMENT = 'Tabla para los usuarios alumnos';

INSERT INTO `academia`.`alumno` (`dni`, `nombre`, `apellidos`, `email`, `password1`, `password2`) VALUES ('12508425J', 'Javier', 'Velazquez Nieto', 'javiervnieto99@gmail.com', 'contraseña1', 'contraseña1');
INSERT INTO `academia`.`alumno` (`dni`, `nombre`, `apellidos`, `email`, `password1`, `password2`) VALUES ('12345678L', 'Alberto', 'Prieto Bara', 'alber@gmail.com', 'contraseña1', 'contraseña1');


/* TABLA PROFESORES */
CREATE TABLE `academia`.`profesor` (
  `dni` VARCHAR(9) NOT NULL,
  `nombre` VARCHAR(255) NOT NULL,
  `apellidos` VARCHAR(255) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password1` VARCHAR(20) NOT NULL,
  `password2` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`dni`),
  UNIQUE INDEX `dni_UNIQUE` (`dni` ASC) VISIBLE)
COMMENT = 'Tabla para los usuarios profesores';

INSERT INTO `academia`.`profesor` (`dni`, `nombre`, `apellidos`, `email`, `password1`, `password2`) VALUES ('12457831K', 'Ana', 'Lopez Sanz', 'analop@hotmail.com', 'contraseña1', 'contraseña1');
INSERT INTO `academia`.`profesor` (`dni`, `nombre`, `apellidos`, `email`, `password1`, `password2`) VALUES ('12956843P', 'Miguel', 'Nieto Noval', 'miguelnn@gmail.com', 'contraseña1', 'contraseña1');


/* TABLA TAREAS */
CREATE TABLE `academia`.`tareas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `asignatura` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `estado` VARCHAR(255) NOT NULL,
  `useralumno` VARCHAR(9) NULL,
  `archivo` VARCHAR(255) NULL,
  `fechacreacion` DATE NOT NULL,
  `fechacorreccion` DATE NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `tarea_dni_alumno_idx` (`useralumno` ASC) VISIBLE,
  CONSTRAINT `tarea_dni_alumno`
    FOREIGN KEY (`useralumno`)
    REFERENCES `academia`.`alumno` (`dni`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);




