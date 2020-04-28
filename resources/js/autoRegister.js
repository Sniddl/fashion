const files = require.context('./', true, /\.vue$/i)
var registrationErrors = [];
var successfulComponents = [];

Vue.config.productionTip = false
// Vue.config.devtools = false;

function registerComponent(file) {
    if (files(file).default.name !== undefined) {
        var name = 'vue-' + files(file).default.name;
        Vue.component(name, files(file).default);
        successfulComponents.push([file, name]);
    } else {
        registrationErrors.push(file);
    }
}

files.keys().map(file => registerComponent(file))

if (registrationErrors.length) {
    console.groupCollapsed(
        "%c %cVue Registation Errors!%cClick to see more details.%c ",
        "display:block;border-top: 4px dashed #9b2c2c;height:0.25rem;width:400px;",
        "color:red;font-family:sans-serif;font-size:2rem;-webkit-text-stroke: 1px black;font-weight:bold;display:block;background-color:#fed7d7;width:400px;padding:0.25rem 0.5rem;cursor:pointer;",
        "color:#fc8181;font-family:sans-serif;font-size:1.3rem;font-weight:bold;display:block;background-color:#fed7d7;width:400px;padding:0.25rem 0.5rem;cursor:pointer;",
        "display:block;border-bottom: 4px dashed #9b2c2c;height:0.25rem;width:400px;"
    );
    registrationErrors.map(file => console.log(`%c${file}`,
        "color:#e53e3e;font-size: 1.2rem;font-family:sans-serif;display:block;width:250px;text-overflow:ellipsis;border-radius:3px;"))
    console.groupEnd();
} else {
    console.groupCollapsed("%cSuccessfully registered Vue components.%cClick to see more details.",
        "color:green;font-family:sans-serif;font-size:2rem;font-weight:bold;-webkit-text-stroke: 1px black;cursor:pointer;",
        "color:gray;font-family:sans-serif;font-size:1.3rem;font-weight:bold;display:block;cursor:pointer;")
    successfulComponents.map(data => console.log(`%c${data[0]} %c=> %c<${data[1]}/>`,
        "color:white;font-family:sans-serif;padding:10px;background-color:#4fc08d;display:inline-block;width:200px;text-overflow:ellipsis;border-radius:3px;",
        "color:black;font-size:2rem;font-weight:bold;margin:0px 5px;display:inline-block;",
        "color:black;font-size: 2rem; font-weight:bold;color:goldenrod;display:inline-block;"))
    console.groupEnd();
}

