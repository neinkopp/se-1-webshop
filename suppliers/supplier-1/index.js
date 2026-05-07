const express = require("express");
const fs = require("fs");
const Handlebars = require("handlebars");
const app = express();
app.use(express.json());

app.post("/api/init-checkout", (req, res) => {
  const { order_token, products, customer } = req.body;

  console.log(`[Supplier 1] Checkout initialisiert für Token: ${order_token}`);
  console.log(
    `[Supplier 1] Kunde bekannt: ${customer.name}. Warte auf Zahlungsvorgang...`,
  );

  res.json({
    success: true,
    // Der Kunde wird direkt zur reinen Bezahlmaske geleitet
    payment_url: `http://localhost:3001/pay/${order_token}`,
  });
});

// Simulierte Bezahlseite (Frontend für den Kunden)
app.get("/pay/:token", (req, res) => {
  let source = fs.readFileSync("templates/pay.hbs", "utf8");
  let template = Handlebars.compile(source);
  let data = { token: req.params.token };
  res.send(template(data));
});

app.listen(3001, () => console.log("Dummy 1 (Mit PII) auf 3001"));
