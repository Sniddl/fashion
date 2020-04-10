const args = process.argv.slice(2);
const json = JSON.parse(Buffer.from(args[0], "base64").toString());
console.dir(args);
console.dir(json);
