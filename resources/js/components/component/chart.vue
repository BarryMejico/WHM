<template>
    <div>
        <div class="small">
            <LineChart :chart-data="datacollection"></LineChart>
            <!-- <button @click="fillData()">Update</button> -->
        </div>
    </div>
</template>

<script>
import LineChart from '../../LineChart'
export default{
    components:{
         LineChart
    },
    data(){
        return{

            datacollection: null

        }
    },
    mounted(){
        this.fillData()

    },
    methods:{
         fillData () {
        this.datacollection = {
          labels: ['date 1','date 2','date 3','date 4','date 5','date 6','date 7','date 8'],
          datasets: [
            {
              label: 'Income',
              backgroundColor: '#58508d',
              fill:false,
              borderColor:'#58508d',
              data: [5,2,6,7,3,13,87,4]
            },
            {
              label: 'Expenditures',
              backgroundColor: '#bc5090',
              borderColor:'#bc5090',
              fill:false,
              data: [3,7,2,9,3,21,56,7]
            }
          ]
        }
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      },

    }

}
</script>
<style scoped>
.small {
    max-width: 900px;
    margin:  150px auto;

  }



</style>

