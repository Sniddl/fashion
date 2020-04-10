const fs = require("fs");
const axios = require("axios");

const args = process.argv.slice(2);

const eventContent = fs.readFileSync(process.env.GITHUB_EVENT_PATH, "utf8");
const json = JSON.parse(eventContent);
const hook = process.env.DISCORD_WEBHOOK + "?wait=true";

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

axios
    .post(hook, payload, {
        headers: {
            "Content-Type": "application/json",
            "X-GitHub-Event": process.env.GITHUB_EVENT_NAME || "push"
        }
    })
    .then(res => {
        console.log(`statusCode: ${res.statusCode}`);
        console.log(res);
    })
    .catch(error => {
        console.error(error);
    });
