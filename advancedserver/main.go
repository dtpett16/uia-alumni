package main

import (
	"github.com/astaxie/beego"
	"github.com/astaxie/beego/orm"

	_ "github.com/dtpett16/uia-alumni/models"
	_ "github.com/dtpett16/uia-alumni/routers"
	_ "github.com/go-sql-driver/mysql"
)

func init() {
	orm.RegisterDriver("mysql", orm.DRMySQL)
	mysqlReg := beego.AppConfig.String("root") + ":" +
		beego.AppConfig.String("SED1234ALUMNI") + "@tcp(127.0.0.1:3306)/" +
		beego.AppConfig.String("uiaalumnidb")
	orm.RegisterDataBase("default", "mysql", mysqlReg)
}

func main() {
	beego.BConfig.WebConfig.Session.SessionOn = true
	beego.Run()
}
