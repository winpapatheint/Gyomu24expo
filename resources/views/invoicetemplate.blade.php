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
    <h1 style="text-align: center;">請 求 書</h1>
    <table style="width: 100%;">
      <tr>
        <th style="text-align: left;width: 60%;"><h3>{{ $data['hcompany'] }}    御中</h3></th>
        <th></th>
        <th style="text-align: right;"></th>
      </tr>
      <tr>
        <td>〒{{ $data['postalcode'] }}</td>
        <td>請求書番号</td>
        <td style="text-align: right;">{{ $data['timeid'] }}</td>
      </tr>
      <tr>
        <td>{{ $data['address'] }}</td>
        <td>発行日</td>
        <td style="text-align: right;">{{ date('Y\年m\月d\日', strtotime($data['date'])) }}</td>
      </tr>

      <tr>
        <td>{{ $data['addressextra'] ?? '' }}</td>
        <td></td>
        <td style="text-align: right;"></td>
      </tr>

      <tr>
        <td>TEL:  {{ $data['phone'] }}</td>
        <td></td>
        <td style="text-align: right;"></td>
      </tr>
      <tr>
        <td> &nbsp</td>
        <td></td>
        <td style="text-align: right;"></td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td colspan="2" rowspan="5">{{ $companyinfo['companyname'] }}<br>{{ $companyinfo['postalcode'] }}<br>{{ $companyinfo['address'] }}<br>{{ $companyinfo['addressextra'] }}<br>担当者：　{{ $companyinfo['picname'] }}<br>TEL:  {{ $companyinfo['phone'] }}</td>
      </tr>

      <tr>
        <td>件名：{{ $data['name'] }}</td>
      </tr>
      <tr>
        <td> 合計金額 : ¥{{  number_format((array_sum($data['totalrow']))*1.1) }} 円</td>
        <td></td>
        <td style="text-align: right;"></td>
      </tr>

    </table>

    <hr style="border-top: 1px solid black;">

    <table style="width: 100%; text-align: center;" class="border">
      <tr>
        <th style="text-align: left;width: 60%;">項目</th>
        <th>数量</th>
        <th>単位</th>
        <th>単価</th>
        <th>金額</th>
      </tr>

      @php
      if(isset($data['totalrow'])){
        $countrow = count($data['totalrow']);
      } else {
        $countrow = 1;
      }
      @endphp

      @for ($i = 0; $i < $countrow; $i++)
      <tr>
        <td>{{ $data['label'][$i+1] }}</td>
        <td>{{ number_format($data['quantity'][$i+1]) }}</td>
        <td>{{ $data['unit'][$i+1] }}</td>
        <td>{{ number_format($data['priceperunit'][$i+1]) }}</td>
        <td>{{ number_format($data['totalrow'][$i+1]) }} 円</td>
      </tr>
      @endfor

    </table>

    <hr style="border-top: 1px solid transparent;">

    <table style="width: 100%; text-align: center;" class="border">
      <tr>
        <td style="width: 60%;">小計</td>
        <td>{{  number_format((array_sum($data['totalrow']))) }} 円</td>
      </tr>
      <tr>
        <td>消費税(10%)</td>
        <td>{{  number_format((array_sum($data['totalrow']))*0.1) }} 円</td>
      </tr>
      <tr>
        <th>合計金額</th>
        <td>{{  number_format((array_sum($data['totalrow']))*1.1) }} 円</td>
      </tr>
    </table>

    <hr style="border-top: 1px solid transparent;">

    <table style="width: 100%;" class="border">
    備考欄
      <tr style="vertical-align: top; text-align: left;vertical-align: top;">
        <td style="height: 200px;">{!! $data['remarks'] !!}</td>
      </tr>
    </table>


    <!-- End of your content -->
  </div>
</body>


<script type="text/javascript">
<!--
window.print();
//-->
</script>