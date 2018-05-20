# Advanced server (testing purposes only)
Denne mappen inneholder en mer avansert server. Den krever MySQL installert og følgende go dependencies:
´´´
go get -u github.com/astaxie/beego
go get -u github.com/astaxie/beego/orm
go get -u github.com/go-sql-driver/mysql
go get -u golang.org/x/crypto/nacl/secretbox
´´´

MySQL skal være satt opp med følgende konfigurasjon (med default port 3306, og alt annet default bortsett fra følgende):

* mysqluser = "root"
* mysqlpass = "SED1234ALUMNI"
* mysqldb = "uiaalumnidb"

Implementasjonen er inspirert av: https://github.com/emadera52/sixty 
