"use strict";
requirejs.config({
  packages: [
    {
      name: "CodeMirror",
      location: "codemirror-5.61.0",
      main: "lib/codemirror.js",
    },
  ],
});

requirejs(["CodeMirror"], function (CodeMirror) {
  //This function is called when scripts/helper/util.js is loaded.
  //If util.js calls define(), then this function is not fired until
  //util's dependencies have loaded, and the util argument will hold
  //the module value for "helper/util".
  let cm = CodeMirror.fromTextArea(document.getElementById("paste-text"), {
    lineNumbers: true,
    gutter: true,
    lineWrapping: false,
    autoRefresh: true,
  });
  cm.setSize("90%", 800);
  cm.save();
  cm.on("change", function () {
    validate(cm.getValue());
  });
  document.getElementById("language").addEventListener("change", function () {
    // cm.setOption("mode", this.value);
    cm.mode = this.value;
    // let script = document.createElement("script");
    // script.src = `js/codemirror-5.61.0/mode/${cm.mode}/${cm.mode}.js`;
    // document.body.appendChild(script);
  });
});

// requirejs(["CodeMirror"], function (CodeMirror) {});
