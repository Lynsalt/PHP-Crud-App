 function updateOrder() {
        const TAXRATE = 0.0925;
        const PIEPRICE = 1.50;
        var numPumkinPie = parsePie(document.getElementById("pumkinpie").value);
        var numApplePie = parsePie(document.getElementById("applepie").value);

        if (isNaN(numPumkinPie))
          numPumkinPie = 0;
        if (isNaN(numApplePie))
          numApplePie = 0;
        var subTotal = (numPumkinPie + numApplePie) * PIEPRICE;
        var tax = subTotal * TAXRATE;
        var total = subTotal + tax;
        document.getElementById("subtotal").value = "$" + subTotal.toFixed(2);
        document.getElementById("tax").value = "$" + tax.toFixed(2);
        document.getElementById("total").value = "$" + total.toFixed(2);
      }
      //If user type anything other than letters erase entry
      function lettersOnly(input){
       var regex = /[^a-z]/gi;
       input.value = input.value.replace(regex, "");
      }
      //If user type anything other than numbers erase entry
      function numbersOnly(input){
        var regex = /[^0-9]/g;
        input.value = input.value.replace(regex, "");
      }

      //validate telephone in this order 123-456-7891
      function telephoneCheck(input){
        var regexnum = /[^0-9-]/g;
        input.value = input.value.replace(regexnum, "");
        if(document.getElementById("telephone").value == ""){
          alert("Please provide a valid 10 digit telephone number.");
          return;
        }
      }

  
      //check to see if user type dozen in text field and multiply by 12 (currently not in use)
      function parsePie(pieString) {
        numPies = parseInt(pieString);
        if (pieString.indexOf("dozen") != -1)
            numPies  *= 12;
        return numPies;
      }
      
      //This function willbe used to add a paynow credit card form (currently not in use)
      function btnHide(){
        let cardContainer = document.getElementById("cardContainer");
        let btn = document.getElementById("paynow");
        btn.classList.add('hide-me');
        if(cardContainer.style.display ==="none"){
           cardContainer.style.display ="block";
        }else{
          cardContainer.style.display ="none";
        }
      }
      //final checks before processing form
      function placeOrder(form) {
        var regex = /^\d{3}-\d{3}-\d{4}$/;
        if (document.getElementById("fname").value == ""){
          alert("I'm sorry but you must provide your first name before submitting an order.");
          return false;
        }
        if(document.getElementById("lname").value == ""){
           alert("I'm sorry but you must provide your last name before submitting an order.");
           return false;
         }

        if(document.getElementById("pumkinpie").value == ""){
            alert("please enter the number of pumpkin pies");
            return false;
         }
         if(document.getElementById("applepie").value == ""){
            alert("please enter the number of apple pies");
            return false;
         }
         
        if(!regex.test(document.getElementById("telephone").value)){
          alert("Please enter a phone number with the following pattern. 123-555-2201");
          return false;
        }
         else if (document.getElementById("pickupminutes").value == "" || isNaN(document.getElementById("pickupminutes").value)){
          alert("I'm sorry but you must provide the number of minutes until pick-up before submitting an order."); 
          return false;
        }
        else{
          // Submit the order to the server
          form.submit();
        }
      }
       
      // add the full year at the bottom of the page
      window.onload = projYear;
      function projYear(){
        var date = new Date();
        var curDate = date.getFullYear();
        document.getElementById('the-date').innerHTML =curDate;
      }
      
