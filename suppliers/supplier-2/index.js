const express = require("express");
const fs = require("fs");
const Handlebars = require("handlebars");
const app = express();
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.get("/api/init-checkout", (req, res) => {
  const token = Math.floor(Math.random() * 10000000000).toString();
  console.log(`[Supplier 1] Checkout initialisiert für Token: ${token}`);

  res.redirect("/personal-details/" + token);
});

// Simulierte Bezahlseite (Frontend für den Kunden)
app.get("/personal-details/:token", (req, res) => {
  let source = fs.readFileSync("templates/personal-details.hbs", "utf8");
  let template = Handlebars.compile(source);
  let data = { token: req.params.token };
  res.send(template(data));
});

app.post("/save-details", (req, res) => {
  console.log(req.body);
  res.redirect("/pay/" + req.body.token);
});

app.get("/pay/:token", (req, res) => {
  let source = fs.readFileSync("templates/pay.hbs", "utf8");
  let template = Handlebars.compile(source);
  let data = { token: req.params.token };
  res.send(template(data));
});

app.post("/pay-process", (req, res) => {
  res.redirect("/success");
});

app.get("/success", (req, res) => {
  let source = fs.readFileSync("templates/success.hbs", "utf8");
  let template = Handlebars.compile(source);
  res.send(template());
});

app.listen(3001, () => console.log("Dummy 1 (Mit PII) auf 3001"));
