(()=>{function e(e,n){var r="undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(!r){if(Array.isArray(e)||(r=function(e,n){if(e){if("string"==typeof e)return t(e,n);var r=Object.prototype.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?t(e,n):void 0}}(e))||n&&e&&"number"==typeof e.length){r&&(e=r);var a=0,o=function(){};return{s:o,n:function(){return a>=e.length?{done:!0}:{done:!1,value:e[a++]}},e:function(e){throw e},f:o}}throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}var l,i=!0,u=!1;return{s:function(){r=r.call(e)},n:function(){var e=r.next();return i=e.done,e},e:function(e){u=!0,l=e},f:function(){try{i||null==r.return||r.return()}finally{if(u)throw l}}}}function t(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}var n=document.querySelector(".user-form"),r=document.querySelector(".update-form"),a=document.querySelector(".submit-btn"),o=document.querySelector(".update-btn");function l(t){function n(e){var t=e.parentElement;e.classList.contains("is-invalid")&&(e.classList.remove("is-invalid"),t.querySelector(".error-message").remove())}function r(e,t){var n=e.parentElement,r=n.querySelector(".invalid-feedback"),a=document.createElement("p");e.classList.add("is-invalid"),a.classList.add("error-message"),a.textContent=t,r.appendChild(a),n.appendChild(r)}var a,o=!0,l=document.querySelectorAll(".form-input"),i=document.querySelectorAll(".select-input"),u=e(l);try{for(u.s();!(a=u.n()).done;){var c=a.value;n(c),c.dataset.name&&(c.value.match(/^[a-zA-Z ]*$/)||(n(c),r(c,"Only letters allowed!"),o=!1)),c.dataset.email&&(c.value.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.+([a-zA-Z0-9-]+)*$/)||(n(c),r(c,"Enter email in format: example@mail.com"),o=!1)),""===c.value&&(n(c),r(c,"Fill this field!"),o=!1)}}catch(e){u.e(e)}finally{u.f()}var s,f=e(i);try{for(f.s();!(s=f.n()).done;){var d=s.value;n(d),""===d.value&&(n(d),r(d,"Select a value!"),o=!1)}}catch(e){f.e(e)}finally{f.f()}return o}a&&a.addEventListener("click",(function(e){e.preventDefault(),!0===l()&&n.submit()})),o&&o.addEventListener("click",(function(e){e.preventDefault(),!0===l()&&r.submit()}))})();