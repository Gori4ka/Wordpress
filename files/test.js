//https://codesandbox.io/s/vanilla


// console.log("assdsdfdf"-5)
// console.log(5-"asdfdff")
// console.log(5-"45nb")
// console.log(5-"3")
// console.log('5'-3)
// console.log(105-"15"-"45nb")
// console.log(105-"15"+"45nb")

// console.log("assdsdfdf"*5)
// console.log(5*"asdfdff")
// console.log(5*"45nb")
// console.log(5*"3")
// console.log('5'*3)
// console.log(4 - "5" + 0xf - "1e1"); //0xf havasar e 15 isk 1e1 havasar e 10
//console.log(null + undefined)
//console.log(1.15 + 2.30)
// console.log(null >= 0)
// console.log(null <= 0)
// console.log(null == 0)
// console.log(null === 0)

//console.log(5/0)
//console.log(0/0)
// console.log(Infinity/Infinity)
// console.log(Math.sqrt(-10))
// console.log(NaN === NaN)
// console.log(NaN == NaN)
// console.log(null === undefined)
// console.log(null == undefined)

// var x = "Volvo" + 16 + 4;
// var y = 16 + 4 + "Volvo";
// console.log(x);
// console.log(y);
// console.log(typeof x);
// console.log(typeof y);

// console.log([] + 1 + 2);
// console.log(typeof [])
// console.log([]+1)
// console.log(typeof ([]+1))
// console.log([]+1+2)
// console.log(typeof ([]+1+2))

// console.log(typeof (Infinity))
// console.log(typeof (null))
// console.log(typeof (NaN))
// console.log(typeof (undefined))
// console.log(typeof (42))
// console.log(typeof ("42"))
// console.log(typeof (true))
// console.log(typeof (Symbol()))

//----------------------------
// (function () {
//   console.log(x)
//   var x = 5;
//   console.log(x)
// })();

// var x = 3;
// (function () {
//   console.log(x)
//   var x = 5;
//   console.log(x)
// })();

// var x = 3;
// (function () {
//   console.log(x)
//   var x = 5;
//   console.log(x)
// })();
// console.log(x)

//-----------------------
// var arr = [2, 4, 5, 7];
// for(var i = 0; i < arr.length; i++){
//   setTimeout(function() {
//     console.log("key " + i + " valuen " + arr[i])
//   }, 10)
// }

// for(let i = 0; i < arr.length; i++){
//   setTimeout(function() {
//     console.log("key " + i + " valuen " + arr[i])
//   }, 10)
// }

//---------------closures---------
// const fn = () => {
//   let state = 0;
//   return (param) => {
//     if(param !== undefined){
//       state += param;
//       return null;
//     }
//     return state;
//   }
// }

// const res = fn();
// res(4);
// res(5);
// res(6);
// res(7);
// res(8);
// console.log(res())

// --------------------------------- zamikanie ---------------------------

// var counter = (function(){
//   var count = 0;
//   return function(){
//     return count++
//   }
// }())

// console.log(counter())
// console.log(counter())
// console.log(counter())
// console.log(counter())
// console.log(counter())

// var counter = (function(){
//   var count = 0;
//   return function(num){
//     count = num !== undefined ? num : count;
//     return count++
//   }
// }())

// console.log(counter())
// console.log(counter())
// console.log(counter())
// console.log(counter(0))
// console.log(counter())
// console.log(counter())
// console.log(counter())
// console.log(counter(20))
// console.log(counter())
// console.log(counter())

// var counter = function(num) {
//   counter.count = num !== undefined ? num : counter.count;
//   return counter.count++
// };
// counter.count = 0
// console.log(counter());
// console.log(counter());
// console.log(counter());
// console.log(counter(0));
// console.log(counter());
// console.log(counter());
// console.log(counter());
// console.log(counter(20));
// console.log(counter());
// console.log(counter());

//-----------  https://medium.com/@abraztsov/5-%D0%BD%D0%B5%D1%82%D0%B8%D0%BF%D0%B8%D1%87%D0%BD%D1%8B%D1%85-javascript-%D0%B2%D0%BE%D0%BF%D1%80%D0%BE%D1%81%D0%BE%D0%B2-%D0%BD%D0%B0-%D1%81%D0%BE%D0%B1%D0%B5%D1%81%D0%B5%D0%B4%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B8-9e0370012582  ------------------------

//1.
// var foo = {n: 1};
// var bar = foo;
// foo.x = foo = {n: 2};
// console.log("bar: ", bar)
// console.log(foo)
// console.log(foo.x)

// 2.
// var a = "asd";
// var b = 5;
// var c = a = b;
// // a = b;
// console.log("c: ", c);
// console.log("a: ", a);
// console.log("b: ", b);

//3.
// const add = (a) => {
//   let sum = a;
//   console.log(a)
//   const func = (b) => {
//     if (b) {
//       sum += b;
//       return func;
//     } else {
//       return sum;
//     }
//   };
//   return func;
// };
// console.log(add(5)(3)(6)(8)());

// var a={},
//     b={key:'b'},
//     c={key:'c'};
// console.log("a", a)
// console.log("b ", b)
// console.log("c ", c)
// a[b]=123;
// console.log("111", a[b])
// a[c]=456;
// console.log("a[c]", a[c])

// console.log("22222", a[b]);
// console.log("33333", a[c]);

//4.
// function isThreePassed(){
//   const args = Array.prototype.slice.call(arguments);
//   return args.indexOf(3) !== -1;
//  }
//  console.log(isThreePassed(1,2)) //false
//  console.log(isThreePassed(9,3,4,9)) //true

//5.
// var arr = [1, [1, 2, [3, 4]], [2, 4]];
// const flatten = (arr) => 
// arr.reduce((flat, toFlatten) => 
// flat.concat(Array.isArray(toFlatten) ? flatten(toFlatten) : toFlatten), []);
// console.log(flatten(arr))

//-----------------------https://habr.com/ru/company/ruvds/blog/334538/--------------------

//--------------------------------- Отладка ---------------------------

//1.
// function greet(person) {
//   if (person.name === 'amy') {
//     return 'hey amy'
//   } else {
//     return 'hey arnold'
//   }
// }
// console.log(greet({ name: 'amy' }))

//2
// for (let i = 0; i < 4; i++) {
//   setTimeout(() => console.log(i), 0)
// }

//3.
// let dog = {
//   name: 'doggo',
//   sayName() {
//     console.log(this.name)
//   }
// }
// let sayName = Object.create(dog)
// sayName.sayName()

// //4.
// function Dog(name) {
//   this.name = name
// }
// Dog.prototype.bark = function() {
//   console.log(this.name + ' says woof')
// }
// let fido = new Dog('fido')
// fido.bark()

//5. 
// function isBig(thing) {
//   // js [2] kam [[[2]]] sranc vra anum e hetevyal@ Number([thing].valueOf().toString())
//   console.log(Number(thing.valueOf().toString()))
//   if (thing == 0 || thing == 1 || thing == 2) {
//     return false
//   }
//   return true
// }
// console.log(isBig(1))    // false
// console.log(isBig([[[[2]]]]))  // false
// console.log(isBig([3]))  // true



//-----------------Hoisting------------ https://habr.com/ru/post/239065/ ----------------------------------

// (function() {
// 	var x = 1;

//   function x() {};
//   // x= function(){};
//   // x= () => {};
// 	console.log(x);	
// })()

// var obj = {
// 	a: 1
// };

// (function(obj) {
// 	obj = {
// 		a: 2
//   };
  
//   // obj.a = 2

// console.log("obj.a: ", obj.a)
// })(obj);

// console.log(obj.a);

//----------------------------------------
// Реализовать методы, которые в процессе выполнения строки (2).plus(3).minus(1) дали бы на выходе 
// Number.prototype.plus = function (value) {
// 	return this + value;
// }

// Number.prototype.minus = function (value) {
// 	return this - value;
// }

// console.log((2).plus(5).minus(3))

//-------------------- Куда же без замыканий -------------------

// for (var i = 0; i < 10; i++) {
// 	setTimeout(function () {
// 		console.log(i);
// 	}, 100);
// }

// for (var i = 0; i < 10; i++) {
// 	(function (i) {
// 		setTimeout(function () {
// 			console.log(i);
// 		}, 100);
// 	})(i)
// }

// for (var i = 0; i < 10; i++) {
// 	setTimeout(function (i) {
// 		console.log(i);
// 	}.bind(this, i), 100);
// }

// for (var i = 0; i < 10; i++) {
// 	setTimeout(function (i) {
// 		console.log(i);
// 	}, 100, i);
// }

// for (let i = 0; i < 10; i++) {
// 	setTimeout(function () {
// 		console.log(i);
// 	}, 100);
// }

//----------------------- kardal ---------------------

// function sumArgs() {
//   var array = [].slice.call(arguments);
//   // var array = [].slice.apply(arguments);
//   const arrSum = arr => arr.reduce((a,b) => a + b, 0)
//   return arrSum(array)
// }

// console.log( sumArgs(1, 2, 3) );

// function f(a, b) {
//   if (b !== undefined) {
//     return a + b;
//   } 
//   else {
//     return function (b) {
//       return a + b;
//       }
//     }
// }
// console.log(f(4,5))
// console.log(f(4)(5))


//--------------------- https://jsehelper.blogspot.com/2016/01/javascript.html -------------------------

// console.log("s.d.f.g.h.g.h.j".split("."))
// console.log("s.dfghgh.j".split("."))
// console.log("sd fgh ghj sgshgsdfhdf".split(""))
// console.log("sd fgh ghj sgshgsdfhdf".split("").reverse())
// console.log("sd fgh ghj sgshgsdfhdf".split("").reverse().join(""))
// console.log("sd fgh ghj sgshgsdfhdf".split("").reverse().join("."))

//-------------------------------- https://lpgenerator.ru/blog/2016/03/14/5-tipichnyh-javascript-voprosov-na-sobesedovanii/ -----------------
// function test() {										
//   console.log(a);
//   console.log(foo());
   
//   var a = 1;
//   function foo() {                  =====>    
//      return 2;
//   }
// }

// test();  =======>>>>>>>>
//<<<<<<<<<<<<<========================
// // function test() {
// // var a;
// // function foo() {
// // return 2;
// // }

// // console.log(a);
// // console.log(foo());

// // a = 1;
// // }

// // test();

// var fullname = 'John Doe';
// var obj = {
//    fullname: 'Colin Ihrig',
//    prop: {
//       fullname: 'Aurelio De Rosa',
//       getFullname: function() {
//          return this.fullname;
//       }
//    }
// };
 
// console.log(obj.prop.getFullname());
 
// var test = obj.prop.getFullname;
 
// console.log(test());

// console.log(test.call(obj.prop));

// ---------------------------  https://proglib.io/p/tricky-challenges-js/ -----------------------

// function addBase(base){
//   return function(num){
//     return base + num;
//   }
// }
 
// var addTen = addBase(10);

// console.log(addTen(5)); //15
// console.log(addTen(80)); //90
// console.log(addTen(-5)); //5

// var arr = [1,3,8,65,-1,5,66];
// function getMax(arr){
//   // console.log(Math.max(1,3,8,65,-1,5,66))
//   return Math.max.apply(null, arr);  
// }
// console.log(getMax(arr))



// ------------------------------  https://habr.com/en/company/mailru/blog/269465/ --------------------------------

// Promise.resolve('fo111o')
//   .then(function (res){
//     console.log(res)
//     setTimeout(() => {
//       return 'asder';
//     }, 10)
//   })
//   .then(function (result) {
//     console.log(result);
//   })
//   .catch((err) => console.log(err));

// Promise.resolve('fo111o')
//   .then(function (res){
//     console.log(res)
//     setTimeout(() => {
//       console.log('asder');
//     }, 10)
//     return "fffffff"
//   })
//   .then(function (result) {
//     console.log(result);
//   })
//   .catch((err) => console.log(err));


//--------------------------- async/await ------------------------------

// function scaryClown() {
//   return new Promise(resolve => {
//     setTimeout(() => {
//       resolve('2222222222');
//     }, 2000);
//   });
// }

// async function msg() {
//   const msg = await scaryClown();
//   console.log('Message:', msg);
// }

// msg();


// function getPost(id) {
//   return new Promise((resolve, reject) => {
//     resolve(
//       fetch('https://jsonplaceholder.typicode.com/posts/'+id)
//       .then(response => response.json())
//       .catch(err=>console.log("err: ", err))
//     )
//   });
// }

// function getUser(id) {
//   return new Promise((resolve, reject) => {
//     resolve(
//       fetch(`https://jsonplaceholder.typicode.com/users/${id}`)
//       .then(response => response.json())
//       .catch(err=>console.log("err: ", err))
//     )
//   });
// }

// async function getData(id = 1) {
//   const post = await getPost(id);
//   const user = await getUser(post.userId)
//   console.log('post:', post);
//   console.log("user: ", user)
// }

// getData(22);

// var promise = new Promise(function(resolve, reject) {
//     resolve ("5555555555555")
// })
// async function foo() {
//   const a = await promise
//   console.log(a)
// }
// foo();
// ------------------------ ---                   -------------------------------------

// const a = [{a1: 1, a2: 2}, {a1: 4, a2: 5}, {a1: 3, a2: 2}, {a1: 2, a2: 2}]
// const result = a.filter(({a1}) => a1 > 2);
// console.log(result)

// const arr1 = new Array(4);
// console.log(arr1)
// console.log(arr1.length)
// const arr2 = [5]
// console.log(arr2)
// console.log(arr2.length)
// arr1.push(8)
// arr2.push(8)
// console.log(arr1)
// console.log(arr2)

// const arr = new Array(7)
// console.log(arr)
// console.log(arr.toString())
// const arr = new Array(7,5,6,8)
// console.log(arr)
// console.log(arr.toString())

// var test1 = [];
// test1.push("value");
// test1.push("value2");

// var test2 = new Array();
// test2.push("value");
// test2.push("value2");

// console.log(test1);
// console.log(test2);
// console.log(test1 == test2);
// console.log(test1.value == test2.value);

// console.log(new Array.prototype.constructor(1, 2))
// console.log(new Array(1, 2))
// console.log(Array(1, 2))
// console.log([1, 2])

// const obj1 = {id:1};
// const obj2 = new Object({id: 2});

// console.log(obj1)
// console.log(obj2)

// console.log(typeof (obj1))
// console.log(typeof (obj2))

// obj1.firstName = "name";
// obj1.lastName = "last";

// obj2.firstName = "First name";
// obj2.lastName = "Last name";

// function User() { }
// User.prototype = { admin: false };
// console.log(User)
// let user = new User();
// console.log(user.admin)
// User.prototype = { admin: true };
// console.log(user.admin)

//----------------------------------- https://learn.javascript.ru/quiz/js-basic ----------------------------

// function f() {
//   let a = 5;
//   return new Function('b', 'return a + b');
// }

// alert( f()(1) );


// function f() {
//   let a = 5;
//   return b => {
//     return a + b
//   };
// }

// console.log( f()(1) );
// console.log(new Function("return 55555"))

// f.call(f);

// function f() {
//   alert( this );
// }

// (function(x, f=()=>x){ // consoli mej tpume [2,1,1] isk stex https://codesandbox.io/s/vanilla tpum e [2,1,2]
//   var x;
//   var y = x;
//   x=2;
//   console.log([x,y, f()]);
// })(1)

// var foo = {n: 1}
// var bar = foo;
// foo.x = foo = {n: 2}
// console.log(foo)
// console.log(bar)
// console.log(foo.x)


//--------------------- https://learn.javascript.ru/prototype --------------------------------

// var animal = {
//   eats: true
// };
// var rabbit = {
//   jumps: true
// };

// // var animal = {
// //   eats: true
// // };
// // var rabbit = {
// //   jumps: true,
// //   eats: false
// // };

// rabbit.__proto__ = animal;
// console.log( rabbit.eats )

// var animal = {
//   eats: true
// };

// var rabbit = {
//   jumps: true,
//   __proto__: animal
// };

// console.log( rabbit.hasOwnProperty('jumps') ); 
// console.log( rabbit.hasOwnProperty('eats') );

// var animal = {
//   jumps: 555
// };
// var rabbit = {
//   jumps: 3333
// };
// rabbit.__proto__ = animal;
// console.log( rabbit.jumps );
// delete rabbit.jumps;
// console.log( rabbit.jumps );
// delete animal.jumps;
// console.log( rabbit.jumps );

// var maxSpeed = {
//   getSpeed(params) {
//     return this.speed+params
//   }
// }
// var auto = {
//   speed: 268,
//   __proto__: maxSpeed
// }
// var model = {
//   __proto__ : auto,
//   bmw: 324,
// }
// console.log(model.bmw)
// console.log(model.speed)
// console.log(model.getSpeed("km"))

//---------------------------  object copy -------------------------

// const obj = {a: 1, b: 2, c: 3}

// const newObj = new Object(obj)
// console.log(obj)
// console.log(newObj)
// newObj.b = 333

// const newObj = {...obj};
// console.log(obj)
// console.log(newObj)
// newObj.b = 333


//1: Deep copy using iteration
// function iterationCopy(src) {
//   let target = {};
//   for (let prop in src) {
//     console.log(src)
//     console.log(prop)
//     if (src.hasOwnProperty(prop)) {
//       target[prop] = src[prop];
//     }
//   }
//   return target;
// }
// const newObj = iterationCopy(obj);
// console.log(obj)
// console.log(newObj)
// newObj.b = 333

//2: Converting to JSON and back

// function jsonCopy(src) {
//   return JSON.parse(JSON.stringify(src));
// }
// const source = {a:1, b:2, c:3};
// const target = jsonCopy(source);
// console.log(target); // {a:1, b:2, c:3}
// // Check if clones it and not changing it
// source.a = '555555';
// console.log(source);
// console.log(target);

//3: Using Object.assign

// function bestCopyEver(src) {
//   return Object.assign({}, src);
// }
// const source = {a:1, b:2, c:3};
// const target = bestCopyEver(source);
// console.log(target); // {a:1, b:2, c:3}
// // Check if clones it and not changing it
// target.a = '3333';
// console.log(source);
// console.log(target);

//---------------------------- https://learn.javascript.ru/es-object ------------------------

// let user = { name: "Вася", age: 25 };
// let visitor = { isAdmin: false, visits: true };
// let admin = { isAdmin: true, age: 33 };

// Object.assign(user, visitor, admin);
// console.log(user);

// //es6 spread 
// const user1 = { ...user, ...visitor, ...admin }
// console.log(user1);

// let user = { name: "Вася", isAdmin: false };
// console.log(user)
// // clone = пустой объект + все свойства user
// //const clone = Object.assign({}, user);
// const clone = {...user} //es6
// clone.name = "test name"
// console.log(clone)

// let animal = { /// xosq@ super i masin e vor@ tanum e parenti vra 
//   walk(name) { console.log("my name is " + name); }
// };

// let rabbit = {
//   __proto__: animal,
//   walk() {
//     super.walk("Latxan"); //es gnum e parenti vra ashxatacnume parenti(animal) walk functian vocht e ira michi walk funkcian 
//   }
// };

// let walk = rabbit.walk; // скопируем метод в переменную
// walk(); // вызовет animal.walk()



// console.log(foo(4)(7))

// function foo(a) {
//   return function(b){
//     return a+b
//   }
// }

// const f2 = (a,b) => {
//   if(b !== undefined){
//     return a+b;
//   }else{
//     return (b) => a+b
//   }
// }
// console.log(f2(3, 10))
// console.log(f2(3)(10))

// const f1 = (a) => {
//   let sum = a;
//   const foo = (b) => {
//     if(b !== undefined){
//       sum+=b;
//       return foo;
//     }else {
//       return sum
//     }
//   }
//   return foo
// }

// console.log(f1(1)(3)(5)(6)())


// const arr = [1,3,5,7,9,11,13]

// let arr1 = arr.reduce((previousValue , currentValue, currentIndex, arr)=>{
//   console.log("previousValue", previousValue)
//   console.log("currentValue", currentValue)
//   console.log("currentIndex", currentIndex)
//   console.log("arr", arr)
//   return previousValue * currentValue
// }, 10)
// console.log("arr1", arr1)

// const arr2 = arr.reduce((previousValue , currentValue)=>previousValue + currentValue, 0)
// console.log("arr2", arr2)

// const arrMap = arr.map((item, index) => {
//   console.log(index)
//   console.log(item)
//   return item*3
// })
// console.log(arrMap1)

// const arrMap1 = arr.map((item, index) => item*3 )
// console.log(arrMap1)

// const filter1 = arr.filter((item, index, array) => {
//   console.log("item", item)
//   console.log(index)
//   console.log(array)
//   return item > 6
// })
// console.log(filter1)
// //vochmi ban chi veradarcnum
// arr.forEach(function(item, i, arr) {
//   console.log( i + ": " + item + " (массив:" + arr + ")" );
// });