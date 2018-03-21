package routers

import (
	"github.com/astaxie/beego"
	"github.com/dtpett16/uia-alumni/controllers"
)

func init() {
	beego.Router("/", &controllers.HomeController{})
	beego.Router("/register", &controllers.HomeController{}, "get,post:Register")
	beego.Router("/login", &controllers.HomeController{}, "get,post:Login")
	beego.Router("/profile", &controllers.HomeController{}, "get,post:Profile")
	beego.Router("/logout", &controllers.HomeController{}, "get:Logout")
	beego.Router("/delete", &controllers.HomeController{}, "get:Delete")
	beego.Router("/restricted", &controllers.HomeController{}, "get:Restricted")
	beego.Router("/comments", &controllers.CommentsController{}, "get,post:Comment")
	beego.Router("/blog", &controllers.BlogController{}, "get:Blog")
	beego.Router("/construction", &controllers.ConstructionController{}, "get:Construction")
	// TODO add email service in order to provide email verification
	//	and password reset functionality
	//	beego.Router("/verify/:uuid({[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}})", &controllers.HomeController{}, "get:Verify")
	//	beego.Router("/forgot", &controllers.HomeController{}, "get,post:Forgot")
	//	beego.Router("/reset/:uuid({[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}})", &controllers.HomeController{}, "get,post:Reset")

}
