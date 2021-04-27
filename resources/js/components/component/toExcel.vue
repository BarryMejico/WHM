<template>
<div id="toExcel">
    <b-btn @click="excels()"> Export to Excel</b-btn>
</div>

</template>
<script>

import XLSX from 'xlsx';

export default {
    props:[
        'array1'
    ],
    methods:{
        // a(){
        //     var array = [];
        //     var headers = [];
        //     document.getElementById("mytable th").each(function(index, item) {
        //         headers[index] = $(item).html();
        //     });
        //     document.getElementById("mytable tr").has('td').each(function() {
        //         var arrayItem = {};
        //         $('td', $(this)).each(function(index, item) {
        //             arrayItem[headers[index]] = $(item).html();
        //         });
        //         array.push(arrayItem);
        //     });
        //     alert(array);
        // },
        excels(){


         var workbook = XLSX.utils.book_new();
        
        //var worksheet_data  =  [['hello','world']];
        //var worksheet = XLSX.utils.aoa_to_sheet(worksheet_data);
      
       // var worksheet_data  = document.getElementById("mytable");
        // var worksheet_data2  = document.getElementById("mytable2");

        var worksheet = XLSX.utils.json_to_sheet(this.array1);
        // var worksheet2 = XLSX.utils.table_to_sheet(worksheet_data2);
        
        workbook.SheetNames.push("Test");
        workbook.Sheets["Test"] = worksheet;

        // workbook.SheetNames.push("Test2");
        // workbook.Sheets["Test2"] = worksheet2;
      
         this.exportExcelFile(workbook);
         console.log(workbook.Sheets.Test);



         
      },
      exportExcelFile(workbook) {
    return XLSX.writeFile(workbook, "bookName.xlsx");
      }
    }
}
</script>

<style scoped>


</style>