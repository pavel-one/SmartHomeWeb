<script>
import { Line } from 'vue-chartjs'

export default {
    extends: Line,
    props: ['day', 'url'],
    data () {
        return {
            chartData: {
                labels: [],
                datasets: []
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                    xAxes: [ {
                        gridLines: {
                            display: false
                        }
                    }]
                },
                legend: {
                    display: true
                },
                responsive: true,
                maintainAspectRatio: false
            }
        }
    },
    methods: {
        load: function (first = false) {
            this.$emit('load');
            this.$http.get(window.location.href+'/'+this.url, {
                params: {
                    day: this.day
                }
            }).then(response => {
                let dataset = {
                    label: response.data.label,
                    data: response.data.data,
                    fill: false,
                    borderColor: '#2554FF',
                    backgroundColor: '#2554FF',
                    borderWidth: 1
                };
                this.$emit('loadeddata', {response: response.data});
                this.chartData.labels = response.data.keys;
                this.chartData.datasets[0] = dataset;

                this.renderChart(this.chartData, this.options);
            });
        }
    },
    watch: {
        day: function () {
            this.load();
        }
    },
    mounted () {
        this.load(true);
    }
}
</script>
