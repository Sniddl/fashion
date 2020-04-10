const fs = require("fs");
const args = process.argv.slice(2);

const eventContent = fs.readFileSync(process.env.GITHUB_EVENT_PATH, "utf8");
// const json = JSON.parse(Buffer.from(args[0], "base64").toString());
console.log(process.env);
console.log(JSON.parse(eventContent));
// console.dir(json);
