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

/* para insertar datos  */ el Begin  y end sirve para ejecutar una sentencia  en este caso insert pero tmabien sirve para select....
	Begin 
	insert into persona values(11111,'acarapi','alarcon','armiz gustavo');
	insert into persona values(22222,'damaris','pacari','susan');
	End

/* sentencias como PROMEDIO AVG ,  */
	select P.sexo ,max(E.nota) AS mejor , min(E.nota) as peor ,AVG(E.nota) as promedio, count(P.sexo) as tot
	from Alumno A,InsEva E,Persona P
	where A.cia=E.cia and P.ci=A.cia
	group by P.sexo ////para que no se repita
	having min(E.nota)>10  ////una condicion despues de cada agrupamiento  

/* mas ejemplos */
1. **Función MIN**:
   - La función **MIN** devuelve el valor mínimo de una columna específica.
   - Ejemplo: Supongamos que tenemos una tabla llamada "empleados" con una columna "salario". Queremos encontrar el salario mínimo de todos los empleados:
     ```sql
     SELECT MIN(salario) AS salario_minimo FROM empleados;
     ```

2. **Función MAX**:
   - La función **MAX** devuelve el valor máximo de una columna específica.
   - Ejemplo: Siguiendo con la tabla "empleados", ahora queremos encontrar el salario máximo de todos los empleados:
     ```sql
     SELECT MAX(salario) AS salario_maximo FROM empleados;
     ```

3. **Función AVG**:
   - La función **AVG** calcula el promedio de los valores en una columna.
   - Ejemplo: Si queremos obtener el salario promedio de todos los empleados:
     ```sql
     SELECT AVG(salario) AS salario_promedio FROM empleados;
     ```

4. **Cláusula GROUP BY**:
   - La cláusula **GROUP BY** se utiliza para agrupar filas que tienen los mismos valores en una o más columnas.
   - Ejemplo: Supongamos que tenemos una tabla "ventas" con columnas "producto_id" y "cantidad". Queremos encontrar la cantidad total vendida para cada producto:
     ```sql
     SELECT producto_id, SUM(cantidad) AS total_vendido
     FROM ventas
     GROUP BY producto_id;
     ```

5. **Cláusula HAVING**:
   - La cláusula **HAVING** se utiliza para filtrar los resultados de un grupo después de aplicar la cláusula **GROUP BY**.
   - Ejemplo: Si queremos encontrar los productos cuya cantidad mínima vendida es menor que 5 unidades:
     ```sql
     SELECT producto_id, MIN(cantidad) AS min_cantidad
     FROM ventas
     GROUP BY producto_id
     HAVING MIN(cantidad) < 5;
     ```

BETWEEN datos que se encuentran en un rango 
mostrar las notas entre 40 y 70 
	select  nota
	frim inseva 
	where nota between  40 and  70 

IN tuplas que estan en una lista  [1,2,3]  entonces nos mostrara 	solo las personas que tengan esa nota osea 1 , 2 ,3
	select nota 
	from inseva
	where nota IN(31,77,85)

LIKE se usa sobre textos , puede contener  los siguentes  simbolos 
1. %  una serie cualquiera de caracteres
2. _  un caracter cualquiera 
	para 1  
	ejemplo mostrar alos alumnos que su apellido inicie con "B"
		select *
		from Persona P
		join Alumno A ON P.ci=A.cia
		where P.paterno like 'B%'

	para 2
	ejemplo mostrar alumnos que tengan 'A_UVIRI' en el paterno , se desconoce la letra '_'
		select *
		from Persona P
		join Alumno A ON P.ci=A.cia
		where P.paterno like 'A_UVIRI'

ORDER  por numero de columnas(orden)
	ejemplo mostrar nombre ,paterno,materno de perosna ordenada por columnas 2,3,1 
		select nombre ,paterno,materno
		from persona
		Order By 2,3,1    //esto significa que primero se ordenaran primero por paterno=2  y luego materno=3  y luego nombre=1

LOWER(texto) : convierte el texto en minuscula 
UPPER(texto) : convierte el texto en mayuscula
INITCAP(texto) : coloca la primera letra de cada palabra en mayuscula

ANY
	Compara con cualquier registro de la subconsulta. La instrucción es válida si hay un registro en la subconsulta que permite que la 	comparación sea cierta.
SOME
	Se suele utilizar la palabra ANY (SOME es un sinónimo)
ALL
	Compara con todos los registros de la consulta. La instrucción resulta cierta si es cierta toda comparación con los registros de la subconsulta
IN
	No usa comparador, ya que sirve para comprobar si un valor se encuentra en el resultado de la subconsulta
NOT IN
	Comprueba si un valor no se encuentra en una subconsulta

Ejemplo: Mostrar todos los alumnos cuya nota sea mayor al de Bonilla en el paterno
	Select P.nombre, E.nota
	From Alumno A, InsEva E, Persona P
	Where A.cia=E.cia and A.cia = P.ci AND E.nota > ALL (
					Select E.nota
					From InsEva E, Alumno A, Persona P
					Where P.paterno= 'BONILLA' AND A.cia=E.cia and
					A.cia=P.ci)