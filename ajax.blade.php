<script type="text/javascript">
    $('#search').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'search':$value},
            success:function(data){
                $('tbody').html(data);

            }
        });
    })
</script>

<-------------------------------------------->

Controller Code:
public function index()

        {
            return view('search.search');
        }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $user=DB::table('login')->where('username','LIKE','%'.$request->search."%")->get();
            if($user)
            {
                foreach ($user as $key => $table) {
                    $output.=
                        '<td>'.$table->id.'</td>'.
                        '<td>'.$table->username.'</td>'.
                        '<td>'.$table->password.'</td>'.
                        '<td>'.'<button type="button" class="btn btn-warning rounded btn-xs" data-toggle="modal" data-target="#ModalLoginForm'. $table->id . '">' .
                        'Edit </button>' . '</td>'. '</tr>';
                } ?>



                <?php return Response($output);
            }
        }
    }
}
