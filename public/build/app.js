(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["app"],{

/***/ "./assets/css/app.css":
/*!****************************!*\
  !*** ./assets/css/app.css ***!
  \****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./assets/js/app.js":
/*!**************************!*\
  !*** ./assets/js/app.js ***!
  \**************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var core_js_modules_es_array_for_each__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.array.for-each */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_for_each__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_for_each__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_array_from__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.array.from */ "./node_modules/core-js/modules/es.array.from.js");
/* harmony import */ var core_js_modules_es_array_from__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_from__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_array_sort__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.array.sort */ "./node_modules/core-js/modules/es.array.sort.js");
/* harmony import */ var core_js_modules_es_array_sort__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_sort__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.string.iterator */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_web_dom_collections_for_each__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_for_each__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _css_app_css__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../css/app.css */ "./assets/css/app.css");
/* harmony import */ var _css_app_css__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_css_app_css__WEBPACK_IMPORTED_MODULE_5__);






/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
// any CSS you import will output into a single css file (app.css in this case)

var startButton = document.getElementById('start-btn');
var nextButton = document.getElementById('next-btn');
var questionContainerElement = document.getElementById('question-container');
var questionElement = document.getElementById('question');
var answerButtonsElement = document.getElementById('answer-buttons');
var shuffledQuestions, currentQuestionIndex;
startButton.addEventListener('click', startGame);
nextButton.addEventListener('click', function () {
  currentQuestionIndex++;
  setNextQuestion();
});

function startGame() {
  startButton.classList.add('hide');
  shuffledQuestions = questions.sort(function () {
    return Math.random() - .5;
  });
  currentQuestionIndex = 0;
  questionContainerElement.classList.remove('hide');
  setNextQuestion();
}

function setNextQuestion() {
  resetState();
  showQuestion(shuffledQuestions[currentQuestionIndex]);
}

function showQuestion(question) {
  questionElement.innerText = question.question;
  question.answers.forEach(function (answer) {
    var button = document.createElement('button');
    button.innerText = answer.text;
    button.classList.add('btn');

    if (answer.correct) {
      button.dataset.correct = answer.correct;
    }

    button.addEventListener('click', selectAnswer);
    answerButtonsElement.appendChild(button);
  });
}

function resetState() {
  clearStatusClass(document.body);
  nextButton.classList.add('hide');

  while (answerButtonsElement.firstChild) {
    answerButtonsElement.removeChild(answerButtonsElement.firstChild);
  }
}

function selectAnswer(e) {
  var selectedButton = e.target;
  var correct = selectedButton.dataset.correct;
  setStatusClass(document.body, correct);
  Array.from(answerButtonsElement.children).forEach(function (button) {
    setStatusClass(button, button.dataset.correct);
  });

  if (shuffledQuestions.length > currentQuestionIndex + 1) {
    nextButton.classList.remove('hide');
  } else {
    startButton.innerText = 'Restart';
    startButton.classList.remove('hide');
  }
}

function setStatusClass(element, correct) {
  clearStatusClass(element);

  if (correct) {
    element.classList.add('correct');
  } else {
    element.classList.add('wrong');
  }
}

function clearStatusClass(element) {
  element.classList.remove('correct');
  element.classList.remove('wrong');
}

var questions = [{
  question: '2 + 2 =',
  answers: [{
    text: '4',
    correct: true
  }, {
    text: '22',
    correct: false
  }]
}, {
  question: 'clique sur 1',
  answers: [{
    text: '1',
    correct: true
  }, {
    text: '1',
    correct: true
  }, {
    text: '1',
    correct: true
  }, {
    text: '1',
    correct: true
  }]
}, {
  question: 'clique sur 2',
  answers: [{
    text: '1',
    correct: false
  }, {
    text: '2',
    correct: true
  }, {
    text: '3',
    correct: false
  }, {
    text: '4',
    correct: false
  }]
}, {
  question: '4 * 2 =',
  answers: [{
    text: '6',
    correct: false
  }, {
    text: '8',
    correct: true
  }]
}];

/***/ })

},[["./assets/js/app.js","runtime","vendors~app"]]]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvY3NzL2FwcC5jc3MiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL2FwcC5qcyJdLCJuYW1lcyI6WyJzdGFydEJ1dHRvbiIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJuZXh0QnV0dG9uIiwicXVlc3Rpb25Db250YWluZXJFbGVtZW50IiwicXVlc3Rpb25FbGVtZW50IiwiYW5zd2VyQnV0dG9uc0VsZW1lbnQiLCJzaHVmZmxlZFF1ZXN0aW9ucyIsImN1cnJlbnRRdWVzdGlvbkluZGV4IiwiYWRkRXZlbnRMaXN0ZW5lciIsInN0YXJ0R2FtZSIsInNldE5leHRRdWVzdGlvbiIsImNsYXNzTGlzdCIsImFkZCIsInF1ZXN0aW9ucyIsInNvcnQiLCJNYXRoIiwicmFuZG9tIiwicmVtb3ZlIiwicmVzZXRTdGF0ZSIsInNob3dRdWVzdGlvbiIsInF1ZXN0aW9uIiwiaW5uZXJUZXh0IiwiYW5zd2VycyIsImZvckVhY2giLCJhbnN3ZXIiLCJidXR0b24iLCJjcmVhdGVFbGVtZW50IiwidGV4dCIsImNvcnJlY3QiLCJkYXRhc2V0Iiwic2VsZWN0QW5zd2VyIiwiYXBwZW5kQ2hpbGQiLCJjbGVhclN0YXR1c0NsYXNzIiwiYm9keSIsImZpcnN0Q2hpbGQiLCJyZW1vdmVDaGlsZCIsImUiLCJzZWxlY3RlZEJ1dHRvbiIsInRhcmdldCIsInNldFN0YXR1c0NsYXNzIiwiQXJyYXkiLCJmcm9tIiwiY2hpbGRyZW4iLCJsZW5ndGgiLCJlbGVtZW50Il0sIm1hcHBpbmdzIjoiOzs7Ozs7Ozs7QUFBQSx1Qzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQ0FBOzs7Ozs7QUFPQTtBQUVBO0FBRUEsSUFBTUEsV0FBVyxHQUFHQyxRQUFRLENBQUNDLGNBQVQsQ0FBd0IsV0FBeEIsQ0FBcEI7QUFDQSxJQUFNQyxVQUFVLEdBQUdGLFFBQVEsQ0FBQ0MsY0FBVCxDQUF3QixVQUF4QixDQUFuQjtBQUNBLElBQU1FLHdCQUF3QixHQUFHSCxR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QUFJLEVBQUUsR0FBUjtBQUFhQyxXQUFPLEVBQUU7QUFBdEIsR0FKTztBQUZYLENBUmdCLEVBaUJoQjtBQUNFUixVQUFRLEVBQUUsY0FEWjtBQUVFRSxTQUFPLEVBQUUsQ0FDUDtBQUFFSyxRQUFJLEVBQUUsR0FBUjtBQUFhQyxXQUFPLEVBQUU7QUFBdEIsR0FETyxFQUVQO0FBQUVELFFBQUksRUFBRSxHQUFSO0FBQWFDLFdBQU8sRUFBRTtBQUF0QixHQUZPLEVBR1A7QUFBRUQsUUFBSSxFQUFFLEdBQVI7QUFBYUMsV0FBTyxFQUFFO0FBQXRCLEdBSE8sRUFJUDtBQUFFRCxRQUFJLEVBQUUsR0FBUjtBQUFhQyxXQUFPLEVBQUU7QUFBdEIsR0FKTztBQUZYLENBakJnQixFQTBCaEI7QUFDRVIsVUFBUSxFQUFFLFNBRFo7QUFFRUUsU0FBTyxFQUFFLENBQ1A7QUFBRUssUUFBSSxFQUFFLEdBQVI7QUFBYUMsV0FBTyxFQUFFO0FBQXRCLEdBRE8sRUFFUDtBQUFFRCxRQUFJLEVBQUUsR0FBUjtBQUFhQyxXQUFPLEVBQUU7QUFBdEIsR0FGTztBQUZYLENBMUJnQixDQUFsQixDIiwiZmlsZSI6ImFwcC5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIGV4dHJhY3RlZCBieSBtaW5pLWNzcy1leHRyYWN0LXBsdWdpbiIsIi8qXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXG4gKlxuICogV2UgcmVjb21tZW5kIGluY2x1ZGluZyB0aGUgYnVpbHQgdmVyc2lvbiBvZiB0aGlzIEphdmFTY3JpcHQgZmlsZVxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cbiAqL1xuXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5cbmltcG9ydCAnLi4vY3NzL2FwcC5jc3MnO1xuXG5jb25zdCBzdGFydEJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzdGFydC1idG4nKVxuY29uc3QgbmV4dEJ1dHRvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCduZXh0LWJ0bicpXG5jb25zdCBxdWVzdGlvbkNvbnRhaW5lckVsZW1lbnQgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncXVlc3Rpb24tY29udGFpbmVyJylcbmNvbnN0IHF1ZXN0aW9uRWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdxdWVzdGlvbicpXG5jb25zdCBhbnN3ZXJCdXR0b25zRWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdhbnN3ZXItYnV0dG9ucycpXG5cbmxldCBzaHVmZmxlZFF1ZXN0aW9ucywgY3VycmVudFF1ZXN0aW9uSW5kZXhcblxuc3RhcnRCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBzdGFydEdhbWUpXG5uZXh0QnV0dG9uLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgKCkgPT4ge1xuICBjdXJyZW50UXVlc3Rpb25JbmRleCsrXG4gIHNldE5leHRRdWVzdGlvbigpXG59KVxuXG5mdW5jdGlvbiBzdGFydEdhbWUoKSB7XG4gIHN0YXJ0QnV0dG9uLmNsYXNzTGlzdC5hZGQoJ2hpZGUnKVxuICBzaHVmZmxlZFF1ZXN0aW9ucyA9IHF1ZXN0aW9ucy5zb3J0KCgpID0+IE1hdGgucmFuZG9tKCkgLSAuNSlcbiAgY3VycmVudFF1ZXN0aW9uSW5kZXggPSAwXG4gIHF1ZXN0aW9uQ29udGFpbmVyRWxlbWVudC5jbGFzc0xpc3QucmVtb3ZlKCdoaWRlJylcbiAgc2V0TmV4dFF1ZXN0aW9uKClcbn1cblxuZnVuY3Rpb24gc2V0TmV4dFF1ZXN0aW9uKCkge1xuICByZXNldFN0YXRlKClcbiAgc2hvd1F1ZXN0aW9uKHNodWZmbGVkUXVlc3Rpb25zW2N1cnJlbnRRdWVzdGlvbkluZGV4XSlcbn1cblxuZnVuY3Rpb24gc2hvd1F1ZXN0aW9uKHF1ZXN0aW9uKSB7XG4gIHF1ZXN0aW9uRWxlbWVudC5pbm5lclRleHQgPSBxdWVzdGlvbi5xdWVzdGlvblxuICBxdWVzdGlvbi5hbnN3ZXJzLmZvckVhY2goYW5zd2VyID0+IHtcbiAgICBjb25zdCBidXR0b24gPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdidXR0b24nKVxuICAgIGJ1dHRvbi5pbm5lclRleHQgPSBhbnN3ZXIudGV4dFxuICAgIGJ1dHRvbi5jbGFzc0xpc3QuYWRkKCdidG4nKVxuICAgIGlmIChhbnN3ZXIuY29ycmVjdCkge1xuICAgICAgYnV0dG9uLmRhdGFzZXQuY29ycmVjdCA9IGFuc3dlci5jb3JyZWN0XG4gICAgfVxuICAgIGJ1dHRvbi5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIHNlbGVjdEFuc3dlcilcbiAgICBhbnN3ZXJCdXR0b25zRWxlbWVudC5hcHBlbmRDaGlsZChidXR0b24pXG4gIH0pXG59XG5cbmZ1bmN0aW9uIHJlc2V0U3RhdGUoKSB7XG4gIGNsZWFyU3RhdHVzQ2xhc3MoZG9jdW1lbnQuYm9keSlcbiAgbmV4dEJ1dHRvbi5jbGFzc0xpc3QuYWRkKCdoaWRlJylcbiAgd2hpbGUgKGFuc3dlckJ1dHRvbnNFbGVtZW50LmZpcnN0Q2hpbGQpIHtcbiAgICBhbnN3ZXJCdXR0b25zRWxlbWVudC5yZW1vdmVDaGlsZChhbnN3ZXJCdXR0b25zRWxlbWVudC5maXJzdENoaWxkKVxuICB9XG59XG5cbmZ1bmN0aW9uIHNlbGVjdEFuc3dlcihlKSB7XG4gIGNvbnN0IHNlbGVjdGVkQnV0dG9uID0gZS50YXJnZXRcbiAgY29uc3QgY29ycmVjdCA9IHNlbGVjdGVkQnV0dG9uLmRhdGFzZXQuY29ycmVjdFxuICBzZXRTdGF0dXNDbGFzcyhkb2N1bWVudC5ib2R5LCBjb3JyZWN0KVxuICBBcnJheS5mcm9tKGFuc3dlckJ1dHRvbnNFbGVtZW50LmNoaWxkcmVuKS5mb3JFYWNoKGJ1dHRvbiA9PiB7XG4gICAgc2V0U3RhdHVzQ2xhc3MoYnV0dG9uLCBidXR0b24uZGF0YXNldC5jb3JyZWN0KVxuICB9KVxuICBpZiAoc2h1ZmZsZWRRdWVzdGlvbnMubGVuZ3RoID4gY3VycmVudFF1ZXN0aW9uSW5kZXggKyAxKSB7XG4gICAgbmV4dEJ1dHRvbi5jbGFzc0xpc3QucmVtb3ZlKCdoaWRlJylcbiAgfSBlbHNlIHtcbiAgICBzdGFydEJ1dHRvbi5pbm5lclRleHQgPSAnUmVzdGFydCdcbiAgICBzdGFydEJ1dHRvbi5jbGFzc0xpc3QucmVtb3ZlKCdoaWRlJylcbiAgfVxufVxuXG5mdW5jdGlvbiBzZXRTdGF0dXNDbGFzcyhlbGVtZW50LCBjb3JyZWN0KSB7XG4gIGNsZWFyU3RhdHVzQ2xhc3MoZWxlbWVudClcbiAgaWYgKGNvcnJlY3QpIHtcbiAgICBlbGVtZW50LmNsYXNzTGlzdC5hZGQoJ2NvcnJlY3QnKVxuICB9IGVsc2Uge1xuICAgIGVsZW1lbnQuY2xhc3NMaXN0LmFkZCgnd3JvbmcnKVxuICB9XG59XG5cbmZ1bmN0aW9uIGNsZWFyU3RhdHVzQ2xhc3MoZWxlbWVudCkge1xuICBlbGVtZW50LmNsYXNzTGlzdC5yZW1vdmUoJ2NvcnJlY3QnKVxuICBlbGVtZW50LmNsYXNzTGlzdC5yZW1vdmUoJ3dyb25nJylcbn1cblxuY29uc3QgcXVlc3Rpb25zID0gW1xuICB7XG4gICAgcXVlc3Rpb246ICcyICsgMiA9JyxcbiAgICBhbnN3ZXJzOiBbXG4gICAgICB7IHRleHQ6ICc0JywgY29ycmVjdDogdHJ1ZSB9LFxuICAgICAgeyB0ZXh0OiAnMjInLCBjb3JyZWN0OiBmYWxzZSB9XG4gICAgXVxuICB9LFxuICB7XG4gICAgcXVlc3Rpb246ICdjbGlxdWUgc3VyIDEnLFxuICAgIGFuc3dlcnM6IFtcbiAgICAgIHsgdGV4dDogJzEnLCBjb3JyZWN0OiB0cnVlIH0sXG4gICAgICB7IHRleHQ6ICcxJywgY29ycmVjdDogdHJ1ZSB9LFxuICAgICAgeyB0ZXh0OiAnMScsIGNvcnJlY3Q6IHRydWUgfSxcbiAgICAgIHsgdGV4dDogJzEnLCBjb3JyZWN0OiB0cnVlIH1cbiAgICBdXG4gIH0sXG4gIHtcbiAgICBxdWVzdGlvbjogJ2NsaXF1ZSBzdXIgMicsXG4gICAgYW5zd2VyczogW1xuICAgICAgeyB0ZXh0OiAnMScsIGNvcnJlY3Q6IGZhbHNlIH0sXG4gICAgICB7IHRleHQ6ICcyJywgY29ycmVjdDogdHJ1ZSB9LFxuICAgICAgeyB0ZXh0OiAnMycsIGNvcnJlY3Q6IGZhbHNlIH0sXG4gICAgICB7IHRleHQ6ICc0JywgY29ycmVjdDogZmFsc2UgfVxuICAgIF1cbiAgfSxcbiAge1xuICAgIHF1ZXN0aW9uOiAnNCAqIDIgPScsXG4gICAgYW5zd2VyczogW1xuICAgICAgeyB0ZXh0OiAnNicsIGNvcnJlY3Q6IGZhbHNlIH0sXG4gICAgICB7IHRleHQ6ICc4JywgY29ycmVjdDogdHJ1ZSB9XG4gICAgXVxuICB9XG5dXG4iXSwic291cmNlUm9vdCI6IiJ9