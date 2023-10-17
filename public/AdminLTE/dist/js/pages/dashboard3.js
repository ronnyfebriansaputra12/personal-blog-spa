/* global Chart:false */

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true

  $(document).ready(function() {
    var $salesChart = $('#sales-chart');
    var $yearSelect = $('#yearSelect');
    var salesChart; // Declare salesChart variable outside the updateChart function
    function updateChart() {
      // Remove the change event listener temporarily to prevent continuous looping
      $yearSelect.off('change', updateChart);
      
      console.log($yearSelect.val());
  
      var selectedYear = $yearSelect.val();
      // Update the fetch URL to include the selected year parameter
      fetch(`http://localhost:8000/dataPerbulan?year=${selectedYear}`)
        .then(response => response.json())
        .then(data => {
          var pemasukan = data.pemasukan;
          var pengeluaran = data.pengeluaran;
  
          var totalPemasukan = 0;
          var totalPengeluaran = 0;
          var labels = [];
          var pemasukanData = [];
          var pengeluaranData = [];
  
          for (let i = 0; i < 12; i++) {
            var monthLabel = getMonthLabel(i);
            labels.push(monthLabel);
      
            var matchingPemasukan = pemasukan.filter(entry => { // Menggunakan filter() untuk mendapatkan semua entri pemasukan pada bulan tertentu
              var entryMonth = new Date(entry.created_at).getMonth();
              return entryMonth === i;
            });
      
            var matchingPengeluaran = pengeluaran.filter(entry => { // Menggunakan filter() untuk mendapatkan semua entri pengeluaran pada bulan tertentu
              var entryMonth = new Date(entry.created_at).getMonth();
              return entryMonth === i;
            });
      
            var totalPengeluaranBulanIni = 0; // Menambahkan variabel totalPemasukanBulanIni untuk menyimpan jumlah pemasukan pada bulan tertentu
      
            var totalPemasukanBulanIni = 0; // Menambahkan variabel totalPemasukanBulanIni untuk menyimpan jumlah pemasukan pada bulan tertentu
      
            matchingPemasukan.forEach(entry => { // Menjumlahkan semua pemasukan pada bulan tertentu
              totalPemasukanBulanIni += entry.jumlah_pemasukan;
            });
      
            matchingPengeluaran.forEach(entry => { // Menjumlahkan semua pemasukan pada bulan tertentu
              totalPengeluaranBulanIni += entry.admin + entry.air_galon + entry.fotografer + entry.jasa_wasit + entry.kebersihan_lapangan + entry.kidman + entry.konten_kreator + entry.korlap + entry.lainnya + entry.laundry + entry.minum_wasit
            });
      
            // totalPengeluaran += totalPengeluaranBulanIni; // Menambahkan jumlah pemasukan bulan ini ke totalPemasukan
            // totalPemasukan += totalPemasukanBulanIni; // Menambahkan jumlah pemasukan bulan ini ke totalPemasukan
      
            pemasukanData.push(totalPemasukanBulanIni); // Memasukkan jumlah pemasukan bulan ini ke dalam pemasukanData
            pengeluaranData.push(totalPengeluaranBulanIni);
      
      
          }
          
          salesChart = new Chart($salesChart, {
            // Chart configuration...
            type: 'bar',
            data: {
              labels: labels,
              datasets: [
                {
                  label: 'Pemasukan',
                  backgroundColor: '#007bff',
                  borderColor: '#007bff',
                  data: pemasukanData
                },
                {
                  label: 'Pengeluaran',
                  backgroundColor: '#ff7f00',
                  borderColor: '#ff7f00',
                  data: pengeluaranData
                }
              ]
            },
            options: {
              maintainAspectRatio: false,
              legend: {
                display: true
              },
              scales: {
                yAxes: [{
                  gridLines: {
                    display: true,
                    lineWidth: '4px',
                    color: 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                  },
                  ticks: {
                    beginAtZero: true,
                    callback: function (value) {
                      return ''+ value.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                    }
                  }
                }],
                xAxes: [{
                  display: true,
                  gridLines: {
                    display: false
                  }
                }]
              }
            }
          });
  
          // Add the change event listener back after the chart has been updated
          $yearSelect.on('change', updateChart);
        })
        .catch(error => {
          console.error('Error fetching data:', error);
          // Add the change event listener back even if there is an error
          $yearSelect.on('change', updateChart);
        });
    }
  
    // Add an event listener to the select element to trigger chart update on selection change
    $yearSelect.on('change', updateChart);
  
    // Call updateChart() initially to display the chart for the default selected year
    updateChart();
  });
  
  function getMonthLabel(monthIndex) {
    var monthNames = [
      'JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN',
      'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'
    ];
    return monthNames[monthIndex];
  }
  



  var $visitorsChart = $('#visitors-chart')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type: 'line',
        data: [100, 120, 170, 167, 180, 177, 160],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [60, 80, 70, 67, 80, 77, 100],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
})

// lgtm [js/unused-local-variable]
