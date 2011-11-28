Que es finance?
===============

Finance es una aplicación totalmente funcional para instituciones financieras, específicamente para cooperativas de ahorro y crédito, incluye un sin número de funcionalidades para el manejos de socios, cuentas, inversiones y créditos.

Requerimientos
--------------

Configure los siguientes apartados antes ejecutar la aplicación:

* PHP server (Apache 2.x o superior).
* PHP 5.3 o superior.
* Mysql server 5.1 o superior
* Symfony 1.4.

Instalación
-----------

```
mkdir /home/finance
git clone git@github.com:joseortega/finance.git /home/finance
```

Para saber que tu configuración de PHP cumple con los requisitos necesarios ejecuta el script que viene con la aplicación desde la línea de comandos:

```
cd /home/finance
php lib/vendor/symfony/data/bin/check_configuration.php
```
Si hay algún problema, la salida te dará toda la información necesaria sobre cómo solucionarlo, También ejecuta el script desde un navegador, copia el archivo en algún lugar bajo el directorio raíz del servidor web y accede al archivo. No te olvides de quitar el archivo del directorio raíz web después:

```
rm web/check_configuration.php
```
Crea una base de datos:

```
mysqladmin -uroot -p create finance
Enter password: mYsEcret ## La clave se mostrará como ********
```
Ahora configure la base de datos para el proyecto:

```
php symfony configure:database "mysql:host=localhost;dbname=finance" root mYsEcret
```
Configure tu servidor web:

```
# Asegúrate de tener sólo una vez esta línea en su configuración
NameVirtualHost 127.0.0.1:8080

# Esta es la configuración de finance
Listen 127.0.0.1:8080

<VirtualHost 127.0.0.1:8080>
  DocumentRoot "/home/finance/web"
  DirectoryIndex index.php
  <Directory "/home/finance/web">
    AllowOverride All
    Allow from All
  </Directory>

  Alias /sf /home/finance/lib/vendor/symfony/data/web/sf
  <Directory "/home/finance/lib/vendor/symfony/data/web/sf">
    AllowOverride All
    Allow from All
  </Directory>
</VirtualHost>
```
 
Ejecutar los siguientes comandos:

```
php symfony propel:insert-sql
php symfony propel:data-load
php symfony plugin:publish-assets 
```
Otorgar permisos para el directorio finance/data

```
sudo chmod -R 2775 /home/finance/data
sudo chgrp -R www-data /home/finance/data
```
Reinicia Apache:

```
sudo /etc/init.d/apache2 restart
```

Comprueba que ahora tienes acceso a la aplicación abriendo un navegador y escribiendo http://localhost:8080/index.php/ e ingresar a la aplicación, con nombre de usuario admin y tu contraseña secret.
