package main

import (
	"html/template"
	"log"
	"net/http"
)

var tpl *template.Template

type pageData struct {
	Title     string
	FirstName string
}

func init() {
	tpl = template.Must(template.ParseGlob("templates/*.html"))
}
func main() {
	http.HandleFunc("/", idx)
	http.HandleFunc("/templates/news.html", abot)
	http.HandleFunc("/templates/subjectMaterial.html", cntct)
	http.HandleFunc("/templates/settings.html", aply)
	http.Handle("/favicon.ivo", http.NotFoundHandler())
	http.ListenAndServe(":8080", nil)
}

func idx(w http.ResponseWriter, req *http.Request) {

	pd := pageData{
		Title: "Index Page",
	}
	err := tpl.ExecuteTemplate(w, "index.html", pd)

	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 1", http.StatusInternalServerError)
		return
	}
}

func abot(w http.ResponseWriter, req *http.Request) {

	pd := pageData{
		Title: "news Page",
	}
	err := tpl.ExecuteTemplate(w, "news.html", pd)

	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 2", http.StatusInternalServerError)
		return
	}
}
func cntct(w http.ResponseWriter, req *http.Request) {

	pd := pageData{
		Title: "subjectMaterial Page",
	}
	err := tpl.ExecuteTemplate(w, "subjectMaterial.html", pd)

	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 3", http.StatusInternalServerError)
		return
	}
}
func aply(w http.ResponseWriter, req *http.Request) {
	pd := pageData{
		Title: "settings Page",
	}
	var first string
	if req.Method == http.MethodPost {
		first = req.FormValue("fname")
		pd.FirstName = first
	}

	err := tpl.ExecuteTemplate(w, "settings.html", pd)
	if err != nil {
		log.Println(err)
		http.Error(w, "Internal server error 4", http.StatusInternalServerError)
		return
	}
}
