#!/usr/bin/env node

const fs = require("fs");
const axios = require("axios");

const args = process.argv.slice(2);

console.log(`${args[0]}/webhook`);

const eventContent = fs.readFileSync(process.env.GITHUB_EVENT_PATH, "utf8");
const json = JSON.parse(eventContent);
let url = process.env.DISCORD_WEBHOOK;

const payload = JSON.stringify({
    content: `Successfully ran '${process.env.GITHUB_JOB}' for '${process.env.GITHUB_REPOSITORY}'\nA comparison can be found at ${json.compare}`,
    embeds: json.commits.map(commit => {
        const title = commit.message
            .split("\n\n")
            .slice(0, 1)
            .join("\n\n");
        const description = commit.message
            .split("\n\n")
            .slice(1)
            .join("\n\n");
        return [
            {
                title,
                description,
                url: commit.url,
                author: {
                    name: commit.author.login,
                    icon_url: commit.author.avatar_url
                }
            }
        ];
    })
});

(async () => {
    console.log("Sending message ...");
    await axios.post(`${url}?wait=true`, payload, {
        headers: {
            "Content-Type": "application/json",
            "X-GitHub-Event": process.env.GITHUB_EVENT_NAME || "push"
        }
    });
    console.log("Message sent ! Shutting down ...");
    process.exit(0);
})().catch(error => {
    console.error("Error :", err.response.status, err.response.statusText);
    console.error("Message :", err.response ? err.response.data : err.message);
    process.exit(1);
});
