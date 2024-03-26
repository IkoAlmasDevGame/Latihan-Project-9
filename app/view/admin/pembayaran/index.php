<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Keuangan Pembayaran</title>
        <?php 
            require_once("../ui/header.php");
        ?>
    </head>

    <body>
        <?php 
            require_once("../ui/navbar.php");
        ?>
        <div class="container-fluid py-5 p-5 bg-secondary rounded-1 min-vh-100">
            <div class="container-fluid bg-body-secondary rounded-1 min-vh-100">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-heading pt-5 text-start">
                            <h4 class="panel-title fs-4 fst-normal fw-lighter">Pembayaran Sekolah</h4>
                        </div>
                        <div class="breadcrumb d-flex justify-content-end align-items-start flex-wrap">
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=beranda&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Beranda</a>
                            </li>
                            <li class="breadcrumb breadcrumb-item">
                                <a href="?page=pembayaran&email=<?=$_SESSION["email_pengguna"]?>" aria-current="page"
                                    class="text-decoration-none">Pembayaran Sekolah</a>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-start flex-wrap">
                    <div class="card col-md-11 col-lg-11">
                        <div class="card-header">
                            <span class="text-end">
                                <h4 class="card-title fst-normal fw-lighter fs-5">List Pembayaran</h4>
                            </span>
                            <form action="?act=get-pembayaran" method="post">
                                <div class="input-group">
                                    <div class="input-group-addon col-md-3 col-lg-3">
                                        <select name="id_kelas" type="submit" onchange="this.form.submit()" required
                                            class="form-control select2">
                                            <option value="">Pilih Kelas</option>
                                            <?php 
                                                $table = "tb_kelas";
                                                $sql_kelas = "SELECT * FROM tb_kelas order by id_kelas asc";
                                                $row_kelas = $configs->prepare($sql_kelas);
                                                $row_kelas->execute();
                                                $ihasil = $row_kelas->fetchAll();
                                                foreach ($ihasil as $key) {
                                            ?>
                                            <option value="<?=$key['id_kelas']?>"><?=$key['namakelas']?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive-md table-responsive-lg">
                            <table class="table table-striped">
                                <?php 
                                    $id_kelas = htmlspecialchars($_GET['id_kelas']) ? htmlentities($_GET['id_kelas']) : $_GET['id_kelas'];
                                    $sql = "SELECT tb_siswa.*, tb_kelas.id_kelas, tb_kelas.namakelas, tb_pendaftaran.id_siswa, tb_pendaftaran.nama_lengkap FROM tb_siswa inner join tb_kelas on tb_siswa.id_kelas = tb_kelas.id_kelas inner join tb_pendaftaran on tb_siswa.id_siswa = tb_pendaftaran.id_siswa WHERE tb_siswa.id_kelas = ?";
                                    $row = $configs->prepare($sql);
                                    $row->execute(array($id_kelas));
                                    $hasil = $row->fetchAll();
                                    foreach ($hasil as $isi) {
                                        function money_format($floatcurr, $curr = 'EUR')
                                            {
                                                $currencies['ARS'] = array(2, ',', '.');          //  Argentine Peso
                                                $currencies['AMD'] = array(2, '.', ',');          //  Armenian Dram
                                                $currencies['AWG'] = array(2, '.', ',');          //  Aruban Guilder
                                                $currencies['AUD'] = array(2, '.', ' ');          //  Australian Dollar
                                                $currencies['BSD'] = array(2, '.', ',');          //  Bahamian Dollar
                                                $currencies['BHD'] = array(3, '.', ',');          //  Bahraini Dinar
                                                $currencies['BDT'] = array(2, '.', ',');          //  Bangladesh, Taka
                                                $currencies['BZD'] = array(2, '.', ',');          //  Belize Dollar
                                                $currencies['BMD'] = array(2, '.', ',');          //  Bermudian Dollar
                                                $currencies['BOB'] = array(2, '.', ',');          //  Bolivia, Boliviano
                                                $currencies['BAM'] = array(2, '.', ',');          //  Bosnia and Herzegovina, Convertible Marks
                                                $currencies['BWP'] = array(2, '.', ',');          //  Botswana, Pula
                                                $currencies['BRL'] = array(2, ',', '.');          //  Brazilian Real
                                                $currencies['BND'] = array(2, '.', ',');          //  Brunei Dollar
                                                $currencies['CAD'] = array(2, '.', ',');          //  Canadian Dollar
                                                $currencies['KYD'] = array(2, '.', ',');          //  Cayman Islands Dollar
                                                $currencies['CLP'] = array(0,  '', '.');          //  Chilean Peso
                                                $currencies['CNY'] = array(2, '.', ',');          //  China Yuan Renminbi
                                                $currencies['COP'] = array(2, ',', '.');          //  Colombian Peso
                                                $currencies['CRC'] = array(2, ',', '.');          //  Costa Rican Colon
                                                $currencies['HRK'] = array(2, ',', '.');          //  Croatian Kuna
                                                $currencies['CUC'] = array(2, '.', ',');          //  Cuban Convertible Peso
                                                $currencies['CUP'] = array(2, '.', ',');          //  Cuban Peso
                                                $currencies['CYP'] = array(2, '.', ',');          //  Cyprus Pound
                                                $currencies['CZK'] = array(2, '.', ',');          //  Czech Koruna
                                                $currencies['DKK'] = array(2, ',', '.');          //  Danish Krone
                                                $currencies['DOP'] = array(2, '.', ',');          //  Dominican Peso
                                                $currencies['XCD'] = array(2, '.', ',');          //  East Caribbean Dollar
                                                $currencies['EGP'] = array(2, '.', ',');          //  Egyptian Pound
                                                $currencies['SVC'] = array(2, '.', ',');          //  El Salvador Colon
                                                $currencies['ATS'] = array(2, ',', '.');          //  Euro
                                                $currencies['BEF'] = array(2, ',', '.');          //  Euro
                                                $currencies['DEM'] = array(2, ',', '.');          //  Euro
                                                $currencies['EEK'] = array(2, ',', '.');          //  Euro
                                                $currencies['ESP'] = array(2, ',', '.');          //  Euro
                                                $currencies['EUR'] = array(2, ',', '.');          //  Euro
                                                $currencies['FIM'] = array(2, ',', '.');          //  Euro
                                                $currencies['FRF'] = array(2, ',', '.');          //  Euro
                                                $currencies['GRD'] = array(2, ',', '.');          //  Euro
                                                $currencies['IEP'] = array(2, ',', '.');          //  Euro
                                                $currencies['ITL'] = array(2, ',', '.');          //  Euro
                                                $currencies['LUF'] = array(2, ',', '.');          //  Euro
                                                $currencies['NLG'] = array(2, ',', '.');          //  Euro
                                                $currencies['PTE'] = array(2, ',', '.');          //  Euro
                                                $currencies['GHC'] = array(2, '.', ',');          //  Ghana, Cedi
                                                $currencies['GIP'] = array(2, '.', ',');          //  Gibraltar Pound
                                                $currencies['GTQ'] = array(2, '.', ',');          //  Guatemala, Quetzal
                                                $currencies['HNL'] = array(2, '.', ',');          //  Honduras, Lempira
                                                $currencies['HKD'] = array(2, '.', ',');          //  Hong Kong Dollar
                                                $currencies['HUF'] = array(0,  '', '.');          //  Hungary, Forint
                                                $currencies['ISK'] = array(0,  '', '.');          //  Iceland Krona
                                                $currencies['INR'] = array(2, '.', ',');          //  Indian Rupee
                                                $currencies['IDR'] = array(2, ',', '.');          //  Indonesia, Rupiah
                                                $currencies['IRR'] = array(2, '.', ',');          //  Iranian Rial
                                                $currencies['JMD'] = array(2, '.', ',');          //  Jamaican Dollar
                                                $currencies['JPY'] = array(0,  '', ',');          //  Japan, Yen
                                                $currencies['JOD'] = array(3, '.', ',');          //  Jordanian Dinar
                                                $currencies['KES'] = array(2, '.', ',');          //  Kenyan Shilling
                                                $currencies['KWD'] = array(3, '.', ',');          //  Kuwaiti Dinar
                                                $currencies['LVL'] = array(2, '.', ',');          //  Latvian Lats
                                                $currencies['LBP'] = array(0,  '', ' ');          //  Lebanese Pound
                                                $currencies['LTL'] = array(2, ',', ' ');          //  Lithuanian Litas
                                                $currencies['MKD'] = array(2, '.', ',');          //  Macedonia, Denar
                                                $currencies['MYR'] = array(2, '.', ',');          //  Malaysian Ringgit
                                                $currencies['MTL'] = array(2, '.', ',');          //  Maltese Lira
                                                $currencies['MUR'] = array(0,  '', ',');          //  Mauritius Rupee
                                                $currencies['MXN'] = array(2, '.', ',');          //  Mexican Peso
                                                $currencies['MZM'] = array(2, ',', '.');          //  Mozambique Metical
                                                $currencies['NPR'] = array(2, '.', ',');          //  Nepalese Rupee
                                                $currencies['ANG'] = array(2, '.', ',');          //  Netherlands Antillian Guilder
                                                $currencies['ILS'] = array(2, '.', ',');          //  New Israeli Shekel
                                                $currencies['TRY'] = array(2, '.', ',');          //  New Turkish Lira
                                                $currencies['NZD'] = array(2, '.', ',');          //  New Zealand Dollar
                                                $currencies['NOK'] = array(2, ',', '.');          //  Norwegian Krone
                                                $currencies['PKR'] = array(2, '.', ',');          //  Pakistan Rupee
                                                $currencies['PEN'] = array(2, '.', ',');          //  Peru, Nuevo Sol
                                                $currencies['UYU'] = array(2, ',', '.');          //  Peso Uruguayo
                                                $currencies['PHP'] = array(2, '.', ',');          //  Philippine Peso
                                                $currencies['PLN'] = array(2, '.', ' ');          //  Poland, Zloty
                                                $currencies['GBP'] = array(2, '.', ',');          //  Pound Sterling
                                                $currencies['OMR'] = array(3, '.', ',');          //  Rial Omani
                                                $currencies['RON'] = array(2, ',', '.');          //  Romania, New Leu
                                                $currencies['ROL'] = array(2, ',', '.');          //  Romania, Old Leu
                                                $currencies['RUB'] = array(2, ',', '.');          //  Russian Ruble
                                                $currencies['SAR'] = array(2, '.', ',');          //  Saudi Riyal
                                                $currencies['SGD'] = array(2, '.', ',');          //  Singapore Dollar
                                                $currencies['SKK'] = array(2, ',', ' ');          //  Slovak Koruna
                                                $currencies['SIT'] = array(2, ',', '.');          //  Slovenia, Tolar
                                                $currencies['ZAR'] = array(2, '.', ' ');          //  South Africa, Rand
                                                $currencies['KRW'] = array(0,  '', ',');          //  South Korea, Won
                                                $currencies['SZL'] = array(2, '.', ', ');         //  Swaziland, Lilangeni
                                                $currencies['SEK'] = array(2, ',', '.');          //  Swedish Krona
                                                $currencies['CHF'] = array(2, '.', '\'');         //  Swiss Franc
                                                $currencies['TZS'] = array(2, '.', ',');          //  Tanzanian Shilling
                                                $currencies['THB'] = array(2, '.', ',');          //  Thailand, Baht
                                                $currencies['TOP'] = array(2, '.', ',');          //  Tonga, Paanga
                                                $currencies['AED'] = array(2, '.', ',');          //  UAE Dirham
                                                $currencies['UAH'] = array(2, ',', ' ');          //  Ukraine, Hryvnia
                                                $currencies['USD'] = array(2, '.', ',');          //  US Dollar
                                                $currencies['VUV'] = array(0,  '', ',');          //  Vanuatu, Vatu
                                                $currencies['VEF'] = array(2, ',', '.');          //  Venezuela Bolivares Fuertes
                                                $currencies['VEB'] = array(2, ',', '.');          //  Venezuela, Bolivar
                                                $currencies['VND'] = array(0,  '', '.');          //  Viet Nam, Dong
                                                $currencies['ZWD'] = array(2, '.', ' ');          //  Zimbabwe Dollar
                                                // custom function to generate: ##,##,###.##
                                                function formatinr($input)
                                                {
                                                    $dec = "";
                                                    $pos = strpos($input, ".");
                                                    if ($pos === FALSE)
                                                    {
                                                        //no decimals
                                                    }
                                                    else
                                                    {
                                                        //decimals
                                                        $dec   = substr(round(substr($input, $pos), 2), 1);
                                                        $input = substr($input, 0, $pos);
                                                    }
                                                    $num   = substr($input, -3);    // get the last 3 digits
                                                    $input = substr($input, 0, -3); // omit the last 3 digits already stored in $num
                                                    // loop the process - further get digits 2 by 2
                                                    while (strlen($input) > 0)
                                                    {
                                                        $num   = substr($input, -2).",".$num;
                                                        $input = substr($input, 0, -2);
                                                    }
                                                    return $num.$dec;
                                                }
                                                if ($curr == "INR")
                                                {
                                                    return formatinr($floatcurr);
                                                }
                                                else
                                                {
                                                    return number_format($floatcurr, $currencies[$curr][0], $currencies[$curr][1], $currencies[$curr][2]);
                                                }
}
                                ?>
                                <form action="" method="post">
                                    <input type="hidden" name="id_kelas" value="<?=$isi['id_kelas']?>">
                                    <tbody>
                                        <tr>
                                            <td class="fst-normal fw-lighter fs-5">Nama Pelajar</td>
                                            <td>
                                                <select name="id_siswa" class="form-control" required>
                                                    <option value="">Pilih Data Siswa
                                                        - <?php echo $isi['namakelas'] ?> -
                                                    </option>
                                                    <option value="<?php echo $isi['id_siswa']?>">
                                                        <?php echo $isi['nama_lengkap']; ?>
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fst-normal fw-lighter fs-5">Bulan Input</td>
                                            <td>
                                                <input type="month" name="bulan_input" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fst-normal fw-lighter fs-5">Tanggal Pembayaran</td>
                                            <td>
                                                <input type="date" name="tanggal_input" class="form-control" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fst-normal fw-lighter fs-5">Biaya Pembayaran</td>
                                            <td>
                                                <input type="text" name="total" class="form-control" required
                                                    placeholder="masukkan biaya pembayaran"
                                                    value="<?php echo money_format($floatcurr, $curr = 'IDR'); ?>">
                                            </td>
                                        </tr>
                                    </tbody>
                                </form>
                                <?php
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            require_once("../ui/footer.php");
        ?>