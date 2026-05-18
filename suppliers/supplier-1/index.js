const express = require("express");
const fs = require("fs");
const Handlebars = require("handlebars");
const app = express();
app.use(express.json());

let sessions = [];

app.post("/api/init-checkout", (req, res) => {
  const { order_token, products, customer } = req.body;

  console.log(`[Supplier 1] Checkout initialisiert für Token: ${order_token}`);
  console.log(
    `[Supplier 1] Kunde bekannt: ${customer.name}. Warte auf Zahlungsvorgang...`,
  );

  let filtered = sessions.filter((s) => s.token !== order_token);
  sessions = [filtered, { token: order_token, products }];

  res.json({
    success: true,
    // Der Kunde wird direkt zur reinen Bezahlmaske geleitet
    payment_url: `http://localhost:3001/pay/${order_token}`,
  });
});

// Simulierte Bezahlseite (Frontend für den Kunden)
app.get("/pay/:token", (req, res) => {
  let source = fs.readFileSync("templates/pay.hbs", "utf8");
  console.log(JSON.stringify(sessions));
  let template = Handlebars.compile(source);
  let session = sessions.find((s) => s.token === req.params.token);
  let data = { token: session.token, products: session.products };
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
