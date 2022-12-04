//json_data.php?bac_filier=
$(document).ready(function(){
    console.log('ready')
    // filtr villes by regions
    $('#dut-filier').change(function(){
        console.log("changed");
        var dut_filier =$('#dut-filier').val();
        console.log(dut_filier)
        $.get("/ESTS-INS/json_data.php?bac_filier="+dut_filier,function(filiers,st){
                $('#table-filiers').empty();
                filiers=JSON.parse(filiers);
                
                filiers.forEach(function(filier){
                    console.log(filier)
                    var row='<tr class="bg-white border-b">';
                        row= row+'<th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap'
                        row=row+filier.bac;
                        row=row+'</th><td class="py-4 px-6">'+filier.bac+'</td><td class="py-4 px-6">';
                        row+=filier.nb+'</td><td class="py-4 px-6"><a class="text-blue-600 w-full" href="bac.php?editfilier='+filier.IDFelier+'&bac='+filier.IDType+'">Modifier</a>'
                        row+='</td></tr>';
                        $('#table-filiers').append(row);
                });  
        })
    })
    
    //filter chooses
    $('#choix1').change(function(){
       
        var choix1=$('#choix1').val();
        $.get("json_data.php?choix_id="+choix1,function(choix,st){
           $('#choix2').empty();
            choix=JSON.parse(choix);
            
            choix.forEach(function(ch){
               
                $('#choix2').append('<option value="'+ch.IDFelier+'">'+ch.intitilue+'</option>');
                
            })
        })
    })
})