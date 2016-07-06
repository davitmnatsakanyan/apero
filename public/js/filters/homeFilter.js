app.filter('homeFilter', function(){
   return function(input){
       input = input || '';
       var out = "";
       for(var i = 0; i < input.length; i++){
           out = input[i]
       }
        console.log(input)
   }
});
