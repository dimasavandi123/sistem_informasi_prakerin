        // // In your Javascript (external .js resource or <script> tag)
        
        // $(document).ready(function() {
        //         $('.select2').select2();
            
        //         $('#kelas').change(function() {
        //             var kelasId = $(this).val();
        //             var siswaSelect = $('#siswa');
                    
            
        //             siswaSelect.empty().append('<option value="">Loading...</option>');
            
        //             @php
        //             $siswaData = [];
        //             foreach ($kelas as $kls) {
        //                 foreach ($kls->siswa as $siswa) {
        //                     $siswaData[$kls->id][] = ['id' => $siswa->id, 'nama_siswa' => $siswa->nama_siswa,];
        //                 }
        //             }
        //             @endphp
            
        //             var dataSiswa = @json($siswaData);
            
        //             var siswaOptions = '';
        //             if (dataSiswa[kelasId]) {
        //                 dataSiswa[kelasId].forEach(function(siswa) {
        //                     siswaOptions += `<option value="${siswa.id}">${siswa.nama_siswa}</option>`;
        //                 });
        //             }
            
        //             siswaSelect.empty().append('<option value="">Pilih Siswa</option>' + siswaOptions);
        //         });
            
        //         $('#siswa').change(function() {
        //             var selectedOption = $(this).find('option:selected');
                    
        //         });
        //     });
            



        // {{-- <script>
        //         $(function () {
         
        //              $.ajaxSetup({
        //                  headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        //              });
         
        //              // MENGAMBIL ID SISWA BERDASARKAN KELAS SISWA
        //              $(function(){
        //                  $('#kelas').on('change',function(){
        //                      let id_kelas = $('#kelas').val();
                             
        //                      $.ajax({
        //                          type: 'POST',
        //                          url : "{{ route('getSiswas') }}",
        //                          data: {id_kelas:id_kelas},
        //                          cache: false,
                                 
        //                          success:function(response){
        //                              $('#siswa').html(response.options);
        //                          },
        //                          error: function(data){
        //                              console.log('error',data)
        //                          }
        //                      })
        //                  })
        //              });
         
        //              // MENGAMBIL NILAI NIS AGAR TERINPUT OTOMATIS            
        //              $('#siswa').on('change', function () {
        //                  let id_siswa = $(this).val();
         
        //                   $.ajax({
        //                       type: 'POST',
        //                        url: "{{ route('getNIS') }}",
        //                       data: {id_siswa: id_siswa},
        //                       cache: false,
         
        //                       success: function (response) {
        //                          $('#nis_siswa').val(response.nis_siswa);
        //                       },
        //                       error: function (data) {
        //                          console.log('error', data);
        //                       }
        //                  });
        //              });
        //              $('#tempatPrakerin').on('change', function () {
        //                  let id_tempatPrakerin = $(this).val();
         
        //                   $.ajax({
        //                       type: 'POST',
        //                        url: "{{ route('getPimpinan') }}",
        //                       data: {id_tempatPrakerin: id_tempatPrakerin},
        //                       cache: false,
         
        //                       success: function (response) {
        //                          $('#nama_pimpinan').val(response.nama_pimpinan);
        //                          $('#alamat_dudi').val(response.alamat_dudi);
        //                       },
        //                       error: function (data) {
        //                          console.log('error', data);
        //                       }
        //                  });
        //              }); 
        //          });
        //      </script> --}}