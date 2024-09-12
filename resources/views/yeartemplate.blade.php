<style>
table, th, td {
/*  border: 1px solid black;
  border-collapse: collapse;*/
}

table.border,table.border th,table.border td {
  border: 1px solid black;
  border-collapse: collapse;
}

</style>

<body>
  <div class="page">
    <!-- Your content here -->
    <h1 style="text-align: center;">年次売上管理表（単位：円）<br>（前年度対比）</h1>

    <hr style="border-top: 1px solid transparent;">

    <table style="width: 100%; text-align: center;" class="border">
      <tr>
        <td>年度</td>
        @for ($i = 1; $i <= 12; $i++)
        <td>{{ $i }} 月</td>
        @endfor 
        <td>合計</td>
      </tr>
      @foreach( $data as $y => $year )
      <tr>
        @foreach( $year as $i => $v )
        <td>{{ $v }}</td>
        @endforeach
      </tr>
      @endforeach
    </table>

<!--     <hr style="border-top: 1px solid transparent;">

    <table style="width: 100%; text-align: center;" class="border">
    備考欄
      <tr>
        <td style="height: 200px;"></td>
      </tr>
    </table> -->


    <!-- End of your content -->
  </div>
</body>


<script type="text/javascript">
<!--
window.print();
//-->
</script>