/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/js/form-validation.js":
/*!**************************************!*\
  !*** ./assets/js/form-validation.js ***!
  \**************************************/
/***/ (() => {

eval("function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== \"undefined\" && o[Symbol.iterator] || o[\"@@iterator\"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === \"number\") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError(\"Invalid attempt to iterate non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it[\"return\"] != null) it[\"return\"](); } finally { if (didErr) throw err; } } }; }\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }\nvar userForm = document.querySelector(\".user-form\");\nvar updateForm = document.querySelector(\".update-form\");\nvar submitUserForm = document.querySelector(\".submit-btn\");\nvar updateUserForm = document.querySelector(\".update-btn\");\nfunction validate(form) {\n  function removeErrors(input) {\n    var parent = input.parentElement;\n    if (input.classList.contains(\"is-invalid\")) {\n      input.classList.remove(\"is-invalid\");\n      parent.querySelector(\".error-message\").remove();\n    }\n  }\n  function createError(input, text) {\n    var parent = input.parentElement;\n    var invalidFeedback = parent.querySelector(\".invalid-feedback\");\n    var errorMessage = document.createElement(\"p\");\n    input.classList.add(\"is-invalid\");\n    errorMessage.classList.add(\"error-message\");\n    errorMessage.textContent = text;\n    invalidFeedback.appendChild(errorMessage);\n    parent.appendChild(invalidFeedback);\n  }\n  var result = true;\n  var inputs = document.querySelectorAll('.form-input');\n  var selects = document.querySelectorAll('.select-input');\n  var _iterator = _createForOfIteratorHelper(inputs),\n    _step;\n  try {\n    for (_iterator.s(); !(_step = _iterator.n()).done;) {\n      var input = _step.value;\n      removeErrors(input);\n      if (input.dataset.name) {\n        if (!input.value.match(/^[a-zA-Z ]*$/)) {\n          removeErrors(input);\n          createError(input, 'Only letters allowed!');\n          result = false;\n        }\n      }\n      if (input.dataset.email) {\n        if (!input.value.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\\.+([a-zA-Z0-9-]+)*$/)) {\n          removeErrors(input);\n          createError(input, 'Enter email in format: example@mail.com');\n          result = false;\n        }\n      }\n      if (input.value === '') {\n        removeErrors(input);\n        createError(input, 'Fill this field!');\n        result = false;\n      }\n    }\n  } catch (err) {\n    _iterator.e(err);\n  } finally {\n    _iterator.f();\n  }\n  var _iterator2 = _createForOfIteratorHelper(selects),\n    _step2;\n  try {\n    for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {\n      var select = _step2.value;\n      removeErrors(select);\n      if (select.value === '') {\n        removeErrors(select);\n        createError(select, 'Select a value!');\n        result = false;\n      }\n    }\n  } catch (err) {\n    _iterator2.e(err);\n  } finally {\n    _iterator2.f();\n  }\n  return result;\n}\nif (submitUserForm) {\n  submitUserForm.addEventListener('click', function (e) {\n    e.preventDefault();\n    if (validate(userForm) === true) {\n      userForm.submit();\n    }\n  });\n}\nif (updateUserForm) {\n  updateUserForm.addEventListener('click', function (e) {\n    e.preventDefault();\n    if (validate(updateForm) === true) {\n      updateForm.submit();\n    }\n  });\n}\n\n//# sourceURL=webpack://php-tasks/./assets/js/form-validation.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./assets/js/form-validation.js"]();
/******/ 	
/******/ })()
;