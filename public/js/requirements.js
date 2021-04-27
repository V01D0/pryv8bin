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
  let cm = CodeMirror.fromTextArea(document.getElementById("paste"), {
    lineNumbers: true,
    gutter: true,
    lineWrapping: false,
    autoRefresh: true,
    theme: "monokai",
    readOnly: true,
  });
  cm.setSize("70%", 700);
  cm.save();
});

// requirejs(["CodeMirror"], function (CodeMirror) {});
