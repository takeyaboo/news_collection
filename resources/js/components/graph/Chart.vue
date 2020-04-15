<script>
import { Bar } from 'vue-chartjs';


export default {
  extends: Bar,
  name: 'chart',
  data () {
    return {
      data: {
        labels: [],
        datasets: [
          {
            label: 'Bar Dataset',
            data: [],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
          },
          {
            label: 'Line Dataset',
            data: [],
            borderColor: '#CFD8DC',
            fill: false,
            type: 'line',
            lineTension: 0.3,
          }
        ]
      },
      options: {
        scales: {
          xAxes: [{
            scaleLabel: {
              display: true,
              labelString: 'お気に入りのキーワードトップ6'
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 10,
            }
          }]
        }
      }
    }
  },
  props: ['param'],
  mounted () {
    var self = this;
    var id = self.param;
    var url = '/ajax/top/' + id;
    var label = [];
    var val = [];

    axios.get(url).then(function(response){
      for(var i = 0; i < response.data.length; i++){

        if(id == 1){
          label.push(response.data[i].category_name);
          val.push(response.data[i].news_store_num);
        } else if(id == 2){
          label.push(response.data[i].category_name);
          val.push(response.data[i].rel_word_num);
        } else if(id == 3){
          label.push(response.data[i].category_id);
          val.push(response.data[i].news_count);
        }


      }
      self.data.labels = label;
      self.data.datasets[0].data = val;
      self.data.datasets[1].data = val;
      self.renderChart(self.data, self.options)

    });
  }
}
</script>
