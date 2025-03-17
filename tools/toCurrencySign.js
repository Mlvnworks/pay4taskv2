function toCurrencySign(value) {
  if (typeof value === "string") {
    value = parseFloat(value);
  }

  if (isNaN(value)) {
    return "Invalid number";
  }
  return "₱" + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
}
