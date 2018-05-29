
// data.js
 function mascara_data(campo){ 
              var mydata = ''; 
              mydata = mydata + campo.value; 
              if (mydata.length == 2){ 
                  mydata = mydata + '/'; 
                  campo.value = mydata; 
              } 
              if (mydata.length == 5){ 
                  mydata = mydata + '/'; 
                  campo.value = mydata; 
              } 
              if (mydata.length == 10){ 
                  verifica_data(campo); 
              }
          } // end function

	function verifica_data(campo) { 

            dia = (campo.value.substring(0,2)); 
            mes = (campo.value.substring(3,5)); 
            ano = (campo.value.substring(6,10)); 

            situacao = ""; 
            // verifica o dia valido para cada mes 
            if ((dia < "01")||(dia < "01" || dia > "30") && (  mes == "04" || mes == "06" || mes == "09" || mes == "11" ) || dia > "31") { 
                situacao = "falsa"; 
            } 

            // verifica se o mes e valido 
            if (mes < 01 || mes > 12 ) { 
                situacao = "falsa"; 
            } 

            // verifica se e ano bissexto 
            if (mes == 2 && ( dia < 01 || dia > 29 || ( dia > 28 && (parseInt(ano / 4) != ano / 4)))) { 
                situacao = "falsa"; 
            } 
    
            if (campo.value == "") { 
                situacao = "falsa"; 
            } 
    
            if (situacao == "falsa") { 
                alert("Data inválida!"); 
                campo.focus(); 
            } 
          } // end function
	function verificaData(Data)
		 {
		  var dma = -1;
		  var data = Array(3);
		  var ch = Data.charAt(0); 
		  for(i=0; i < Data.length && (( ch >= '0' && ch <= '9' ) || ( ch == '/' && i != 0 ) ); ){
			   data[++dma] = '';
			   if(ch!='/' && i != 0) return false;
			   if(i != 0 ) ch = Data.charAt(++i);
				if(ch=='0') ch = Data.charAt(++i);
				while( ch >= '0' && ch <= '9' ){
					data[dma] += ch;
					ch = Data.charAt(++i);
				} // end if 
		  } // end for
		  if(ch!='') return false;
		  if(data[0] == '' || isNaN(data[0]) || parseInt(data[0]) < 1) return false;
		  if(data[1] == '' || isNaN(data[1]) || parseInt(data[1]) < 1 || parseInt(data[1]) > 12) return false;
		  if(data[2] == '' || isNaN(data[2]) || ((parseInt(data[2]) < 0 || parseInt(data[2]) > 99 ) && (parseInt(data[2]) < 1900 || parseInt(data[2]) > 9999))) return false;
		  if(data[2] < 50) data[2] = parseInt(data[2]) + 2000;
			else if(data[2] < 100) data[2] = parseInt(data[2]) + 1900;
			  switch(parseInt(data[1])){
			   case 2: { if(((parseInt(data[2])%4!=0 || (parseInt(data[2])%100==0 && parseInt(data[2])%400!=0)) && parseInt(data[0]) > 28) || parseInt(data[0]) > 29 ) return false; break; }
			   case 4: case 6: case 9: case 11: { if(parseInt(data[0]) > 30) return false; break;}
			   default: { if(parseInt(data[0]) > 31) return false;}
		  } // end if
		  return true; 
		 } // end function
		 
// fim data.js		 