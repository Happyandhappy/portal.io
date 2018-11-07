<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Reports_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *  Leads conversions monthly report
     * @param   mixed $month  which month / chart
     * @return  array          chart data
     */
    public function leads_monthly_report($month)
    {
        $result      = $this->db->query('select last_status_change from tblleads where MONTH(last_status_change) = ' . $month . ' AND status = 1 and lost = 0')->result_array();
        $month_dates = array();
        $data        = array();
        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(12, 0, 0, $month, $d, date('Y'));
            if (date('m', $time) == $month) {
                $month_dates[] = _d(date('Y-m-d', $time));
                $data[]        = 0;
            }
        }
        $chart = array(
            'labels' => $month_dates,
            'datasets' => array(
                array(
                    'label' => _l('leads'),
                    'backgroundColor' => 'rgba(197, 61, 169, 0.5)',
                    'borderColor' => '#c53da9',
                    'borderWidth' => 1,
                    'tension' => false,
                    'data' => $data
                )
            )
        );
        foreach ($result as $lead) {
            $i = 0;
            foreach ($chart['labels'] as $date) {
                if (_d($lead['last_status_change']) == $date) {
                    $chart['datasets'][0]['data'][$i]++;
                }
                $i++;
            }
        }

        return $chart;
    }

    public function get_stats_chart_data($label, $where, $dataset_options, $year)
    {
        $chart = array(
            'labels' => array(),
            'datasets' => array(
                array(
                    'label' => $label,
                    'borderWidth' => 1,
                    'tension' => false,
                    'data' => array()
                )
            )
        );

        foreach ($dataset_options as $key => $val) {
            $chart['datasets'][0][$key] = $val;
        }
        $this->load->model('expenses_model');
        $categories = $this->expenses_model->get_category();
        foreach ($categories as $category) {
            $_where['category']   = $category['id'];
            $_where['YEAR(date)'] = $year;
            if (count($where) > 0) {
                foreach ($where as $key => $val) {
                    $_where[$key] = $val;
                }
            }
            array_push($chart['labels'], $category['name']);
            array_push($chart['datasets'][0]['data'], total_rows('tblexpenses', $_where));
        }

        return $chart;
    }

    public function get_expenses_vs_income_report($year = '')
    {
        $this->load->model('expenses_model');

        $months_labels  = array();
        $total_expenses = array();
        $total_income   = array();
        $i              = 0;
        if (!is_numeric($year)) {
            $year = date('Y');
        }
        for ($m = 1; $m <= 12; $m++) {
            array_push($months_labels, _l(date('F', mktime(0, 0, 0, $m, 1))));
            $this->db->select('id')->from('tblexpenses')->where('MONTH(date)', $m)->where('YEAR(date)', $year);
            $expenses = $this->db->get()->result_array();
            if (!isset($total_expenses[$i])) {
                $total_expenses[$i] = array();
            }
            if (count($expenses) > 0) {
                foreach ($expenses as $expense) {
                    $expense = $this->expenses_model->get($expense['id']);
                    $total = $expense->amount;
                    // Check if tax is applied
                    if ($expense->tax != 0) {
                        $total += ($total / 100 * $expense->taxrate);
                    }
                    if ($expense->tax2 != 0) {
                        $total += ($expense->amount / 100 * $expense->taxrate2);
                    }
                    $total_expenses[$i][] = $total;
                }
            } else {
                $total_expenses[$i][] = 0;
            }
            $total_expenses[$i] = array_sum($total_expenses[$i]);
            // Calculate the income
            $this->db->select('amount');
            $this->db->from('tblinvoicepaymentrecords');
            $this->db->join('tblinvoices', 'tblinvoices.id = tblinvoicepaymentrecords.invoiceid');
            $this->db->where('MONTH(tblinvoicepaymentrecords.date)', $m);
            $this->db->where('YEAR(tblinvoicepaymentrecords.date)', $year);
            $payments = $this->db->get()->result_array();
            if (!isset($total_income[$m])) {
                $total_income[$i] = array();
            }
            if (count($payments) > 0) {
                foreach ($payments as $payment) {
                    $total_income[$i][] = $payment['amount'];
                }
            } else {
                $total_income[$i][] = 0;
            }
            $total_income[$i] = array_sum($total_income[$i]);
            $i++;
        }
        $chart = array(
            'labels' => $months_labels,
            'datasets' => array(
                array(
                    'label' => _l('report_sales_type_income'),
                    'backgroundColor' => 'rgba(37,155,35,0.2)',
                    'borderColor' => "#84c529",
                    'borderWidth' => 1,
                    'tension' => false,
                    'data' => $total_income
                ),
                array(
                    'label' => _l('expenses'),
                    'backgroundColor' => 'rgba(252,45,66,0.4)',
                    'borderColor' => "#fc2d42",
                    'borderWidth' => 1,
                    'tension' => false,
                    'data' => $total_expenses
                )
            )
        );

        return $chart;
    }

    /**
     * Chart leads weeekly report
     * @return array  chart data
     */
    public function leads_this_week_report()
    {
        $this->db->where('CAST(last_status_change as DATE) >= "' . date('Y-m-d', strtotime('monday this week')) . '" AND CAST(last_status_change as DATE) <= "' . date('Y-m-d', strtotime('sunday this week')) . '" AND status = 1 and lost = 0');
        $weekly = $this->db->get('tblleads')->result_array();
        $colors = get_system_favourite_colors();
        $chart  = array(
            'labels' => array(
                _l('wd_monday'),
                _l('wd_tuesday'),
                _l('wd_wednesday'),
                _l('wd_thursday'),
                _l('wd_friday'),
                _l('wd_saturday'),
                _l('wd_sunday')
            ),
            'datasets' => array(
                array(
                    'data' => array(
                        0,
                        0,
                        0,
                        0,
                        0,
                        0,
                        0
                    ),
                    'backgroundColor' => array(
                        $colors[0],
                        $colors[1],
                        $colors[2],
                        $colors[3],
                        $colors[4],
                        $colors[5],
                        $colors[6]
                    ),
                    'hoverBackgroundColor' => array(
                        adjust_color_brightness($colors[0], -20),
                        adjust_color_brightness($colors[1], -20),
                        adjust_color_brightness($colors[2], -20),
                        adjust_color_brightness($colors[3], -20),
                        adjust_color_brightness($colors[4], -20),
                        adjust_color_brightness($colors[5], -20),
                        adjust_color_brightness($colors[6], -20)
                    )
                )
            )
        );
        foreach ($weekly as $weekly) {
            $lead_status_day = _l(mb_strtolower('wd_' . date('l', strtotime($weekly['last_status_change']))));
            $i               = 0;
            foreach ($chart['labels'] as $dat) {
                if ($lead_status_day == $dat) {
                    $chart['datasets'][0]['data'][$i]++;
                }
                $i++;
            }
        }

        return $chart;
    }

    public function leads_staff_report()
    {
        $this->load->model('staff_model');
        $staff = $this->staff_model->get();
        if ($this->input->post()) {
            $from_date = to_sql_date($this->input->post('staff_report_from_date'));
            $to_date   = to_sql_date($this->input->post('staff_report_to_date'));
        }
        $chart = array(
            'labels' => array(),
            'datasets' => array(
                array(
                    'label' => _l('leads_staff_report_created'),
                    'backgroundColor' => 'rgba(3,169,244,0.2)',
                    'borderColor' => "#03a9f4",
                    'borderWidth' => 1,
                    'tension' => false,
                    'data' => array()
                ),
                array(
                    'label' => _l('leads_staff_report_lost'),
                    'backgroundColor' => 'rgba(252,45,66,0.4)',
                    'borderColor' => "#fc2d42",
                    'borderWidth' => 1,
                    'tension' => false,
                    'data' => array()
                ),
                array(
                    'label' => _l('leads_staff_report_converted'),
                    'backgroundColor' => 'rgba(37,155,35,0.2)',
                    'borderColor' => "#84c529",
                    'borderWidth' => 1,
                    'tension' => false,
                    'data' => array()
                )
            )
        );
        foreach ($staff as $member) {
            array_push($chart['labels'], $member['firstname'] . ' ' . $member['lastname']);
            if (!isset($to_date) && !isset($from_date)) {

                $this->db->where('CASE WHEN assigned=0 THEN addedfrom='.$member['staffid'].' ELSE assigned='.$member['staffid'].' END
                    AND status=1','',false);
                $total_rows_converted = $this->db->count_all_results('tblleads');

                $total_rows_created   = total_rows('tblleads', array(
                    'addedfrom' => $member['staffid']
                ));

                $this->db->where('CASE WHEN assigned=0 THEN addedfrom='.$member['staffid'].' ELSE assigned='.get_staff_user_id().' END
                    AND lost=1','',false);
                $total_rows_lost      = $this->db->count_all_results('tblleads');

            } else {
                $sql                  = "SELECT COUNT(tblleads.id) as total FROM tblleads WHERE DATE(last_status_change) BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND status = 1 AND CASE WHEN assigned=0 THEN addedfrom=".$member['staffid']." ELSE assigned=".$member['staffid']." END";
                $total_rows_converted = $this->db->query($sql)->row()->total;

                $sql                = "SELECT COUNT(tblleads.id) as total FROM tblleads WHERE DATE(dateadded) BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND addedfrom=" . $member['staffid'] . "";
                $total_rows_created = $this->db->query($sql)->row()->total;

                $sql = "SELECT COUNT(tblleads.id) as total FROM tblleads WHERE DATE(last_status_change) BETWEEN '" . $from_date . "' AND '" . $to_date . "' AND lost = 1 AND CASE WHEN assigned=0 THEN addedfrom=".$member['staffid']." ELSE assigned=".$member['staffid']." END";

                $total_rows_lost = $this->db->query($sql)->row()->total;
            }

            array_push($chart['datasets'][0]['data'], $total_rows_created);
            array_push($chart['datasets'][1]['data'], $total_rows_lost);
            array_push($chart['datasets'][2]['data'], $total_rows_converted);
        }

        return $chart;
    }

    /**
     * Lead conversion by sources report / chart
     * @return arrray chart data
     */
    public function leads_sources_report()
    {
        $this->load->model('leads_model');
        $sources = $this->leads_model->get_source();
        $chart   = array(
            'labels' => array(),
            'datasets' => array(
                array(
                    'label' => _l('report_leads_sources_conversions'),
                    'backgroundColor' => 'rgba(124, 179, 66, 0.5)',
                    'borderColor' => '#7cb342',
                    'data' => array()
                )
            )
        );
        foreach ($sources as $source) {
            array_push($chart['labels'], $source['name']);
            array_push($chart['datasets'][0]['data'], total_rows('tblleads', array(
                'source' => $source['id'],
                'status' => 1,
                'lost' => 0
            )));
        }

        return $chart;
    }

    public function report_by_customer_groups()
    {
        $months_report = $this->input->post('months_report');
        $groups        = $this->clients_model->get_groups();
        if ($months_report != '') {
            $custom_date_select = '';
            if (is_numeric($months_report)) {
               // Last month
               if($months_report == '1'){
                   $beginMonth = date('Y-m-01', strtotime("-$months_report MONTH"));
                   $endMonth   = date('Y-m-t', strtotime('-1 MONTH'));
               } else {
                   $months_report = (int) $months_report;
                   $months_report--;
                   $beginMonth = date('Y-m-01', strtotime("-$months_report MONTH"));
                   $endMonth   = date('Y-m-t');
               }

                $custom_date_select = '(tblinvoicepaymentrecords.date BETWEEN "' . $beginMonth . '" AND "' . $endMonth . '")';
            } elseif($months_report == 'this_month'){
                $custom_date_select = '(tblinvoicepaymentrecords.date BETWEEN "' . date('Y-m-01') . '" AND "' . date('Y-m-t') . '")';
            } elseif($months_report == 'this_year'){
                $custom_date_select = '(tblinvoicepaymentrecords.date BETWEEN "' .
                date('Y-m-d',strtotime(date('Y-01-01'))) .
                '" AND "' .
                date('Y-m-d',strtotime(date('Y-12-31'))) . '")';
            } elseif($months_report == 'last_year'){
             $custom_date_select = '(tblinvoicepaymentrecords.date BETWEEN "' .
                date('Y-m-d',strtotime(date(date('Y',strtotime('last year')).'-01-01'))) .
                '" AND "' .
                date('Y-m-d',strtotime(date(date('Y',strtotime('last year')). '-12-31'))) . '")';
            } elseif ($months_report == 'custom') {
                $from_date = to_sql_date($this->input->post('report_from'));
                $to_date   = to_sql_date($this->input->post('report_to'));
                if ($from_date == $to_date) {
                    $custom_date_select = 'tblinvoicepaymentrecords.date ="' . $from_date . '"';
                } else {
                    $custom_date_select = '(tblinvoicepaymentrecords.date BETWEEN "' . $from_date . '" AND "' . $to_date . '")';
                }
            }
            $this->db->where($custom_date_select);
        }
        $this->db->select('amount,tblinvoicepaymentrecords.date,tblinvoices.clientid,(SELECT GROUP_CONCAT(name) FROM tblcustomersgroups LEFT JOIN tblcustomergroups_in ON tblcustomergroups_in.groupid = tblcustomersgroups.id WHERE customer_id = tblinvoices.clientid) as groups');
        $this->db->from('tblinvoicepaymentrecords');
        $this->db->join('tblinvoices', 'tblinvoices.id = tblinvoicepaymentrecords.invoiceid');
        $this->db->where('tblinvoices.clientid IN (select customer_id FROM tblcustomergroups_in)');
        $this->db->where('tblinvoices.status !=', 5);
        $by_currency = $this->input->post('report_currency');
        if ($by_currency) {
            $this->db->where('currency', $by_currency);
        }
        $payments       = $this->db->get()->result_array();
        $data           = array();
        $data['temp']   = array();
        $data['total']  = array();
        $data['labels'] = array();
        foreach ($groups as $group) {
            if (!isset($data['groups'][$group['name']])) {
                $data['groups'][$group['name']] = $group['name'];
            }
        }
        // If any groups found
        if (isset($data['groups'])) {
            foreach ($data['groups'] as $group) {
                foreach ($payments as $payment) {
                    $p_groups = explode(',', $payment['groups']);
                    foreach ($p_groups as $p_group) {
                        if ($p_group == $group) {
                            $data['temp'][$group][] = $payment['amount'];
                        }
                    }
                }
                array_push($data['labels'], $group);
                if (isset($data['temp'][$group])) {
                    $data['total'][] = array_sum($data['temp'][$group]);
                }
            }
        }
        $chart = array(
            'labels' => $data['labels'],
            'datasets' => array(
                array(
                    'label' => _l('customer_groups'),
                    'backgroundColor' => 'rgba(197, 61, 169, 0.2)',
                    'borderColor' => '#c53da9',
                    'borderWidth' => 1,
                    'tension' => false,
                    'data' => $data['total']
                )
            )
        );

        return $chart;
    }

    public function report_by_payment_modes()
    {
        $this->load->model('payment_modes_model');
        $modes  = $this->payment_modes_model->get('', array(), true, true);
        $year   = $this->input->post('year');
        $colors = get_system_favourite_colors();
        $this->db->select('amount,tblinvoicepaymentrecords.date');
        $this->db->from('tblinvoicepaymentrecords');
        $this->db->where('YEAR(tblinvoicepaymentrecords.date)', $year);
        $this->db->join('tblinvoices', 'tblinvoices.id = tblinvoicepaymentrecords.invoiceid');
        $by_currency = $this->input->post('report_currency');
        if ($by_currency) {
            $this->db->where('currency', $by_currency);
        }
        $all_payments   = $this->db->get()->result_array();
        $chart          = array(
            'labels' => array(),
            'datasets' => array()
        );
        $data           = array();
        $data['months'] = array();
        foreach ($all_payments as $payment) {
            $month   = date('m', strtotime($payment['date']));
            $dateObj = DateTime::createFromFormat('!m', $month);
            $month   = $dateObj->format('F');
            if (!isset($data['months'][$month])) {
                $data['months'][$month] = $month;
            }
        }
        usort($data['months'], function ($a, $b) {
            $month1 = date_parse($a);
            $month2 = date_parse($b);

            return $month1["month"] - $month2["month"];
        });

        foreach ($data['months'] as $month) {
            array_push($chart['labels'], _l($month) . ' - ' . $year);
        }
        $i = 0;
        foreach ($modes as $mode) {
            if (total_rows('tblinvoicepaymentrecords', array(
                'paymentmode' => $mode['id']
            )) == 0) {
                continue;
            }
            $color = '#4B5158';
            if (isset($colors[$i])) {
                $color = $colors[$i];
            }
            $this->db->select('amount,tblinvoicepaymentrecords.date');
            $this->db->from('tblinvoicepaymentrecords');
            $this->db->where('YEAR(tblinvoicepaymentrecords.date)', $year);
            $this->db->where('tblinvoicepaymentrecords.paymentmode', $mode['id']);
            $this->db->join('tblinvoices', 'tblinvoices.id = tblinvoicepaymentrecords.invoiceid');
            $by_currency = $this->input->post('report_currency');
            if ($by_currency) {
                $this->db->where('currency', $by_currency);
            }
            $payments = $this->db->get()->result_array();

            $datasets_data          = array();
            $datasets_data['total'] = array();
            foreach ($data['months'] as $month) {
                $total_payments = array();
                if (!isset($datasets_data['temp'][$month])) {
                    $datasets_data['temp'][$month] = array();
                }
                foreach ($payments as $payment) {
                    $_month  = date('m', strtotime($payment['date']));
                    $dateObj = DateTime::createFromFormat('!m', $_month);
                    $_month  = $dateObj->format('F');
                    if ($month == $_month) {
                        $total_payments[] = $payment['amount'];
                    }
                }
                $datasets_data['total'][] = array_sum($total_payments);
            }
            $chart['datasets'][] = array(
                'label' => $mode['name'],
                'backgroundColor' => $color,
                'borderColor' => adjust_color_brightness($color, -20),
                'tension' => false,
                'borderWidth' => 1,
                'data' => $datasets_data['total']
            );
            $i++;
        }

        return $chart;
    }

    /**
     * Total income report / chart
     * @return array chart data
     */
    public function total_income_report()
    {
        $year = $this->input->post('year');
        $this->db->select('amount,tblinvoicepaymentrecords.date');
        $this->db->from('tblinvoicepaymentrecords');
        $this->db->where('YEAR(tblinvoicepaymentrecords.date)', $year);
        $this->db->join('tblinvoices', 'tblinvoices.id = tblinvoicepaymentrecords.invoiceid');
        $by_currency = $this->input->post('report_currency');
        if ($by_currency) {
            $this->db->where('currency', $by_currency);
        }
        $payments       = $this->db->get()->result_array();
        $data           = array();
        $data['months'] = array();
        $data['temp']   = array();
        $data['total']  = array();
        $data['labels'] = array();
        foreach ($payments as $payment) {
            $month   = date('m', strtotime($payment['date']));
            $dateObj = DateTime::createFromFormat('!m', $month);
            $month   = $dateObj->format('F');
            if (!isset($data['months'][$month])) {
                $data['months'][$month] = $month;
            }
        }
        usort($data['months'], function ($a, $b) {
            $month1 = date_parse($a);
            $month2 = date_parse($b);

            return $month1["month"] - $month2["month"];
        });
        foreach ($data['months'] as $month) {
            foreach ($payments as $payment) {
                $_month  = date('m', strtotime($payment['date']));
                $dateObj = DateTime::createFromFormat('!m', $_month);
                $_month  = $dateObj->format('F');
                if ($month == $_month) {
                    $data['temp'][$month][] = $payment['amount'];
                }
            }
            array_push($data['labels'], _l($month) . ' - ' . $year);
            $data['total'][] = array_sum($data['temp'][$month]);
        }
        $chart = array(
            'labels' => $data['labels'],
            'datasets' => array(
                array(
                    'label' => _l('report_sales_type_income'),
                    'backgroundColor' => 'rgba(37,155,35,0.2)',
                    'borderColor' => "#84c529",
                    'tension' => false,
                    'borderWidth' => 1,
                    'data' => $data['total']
                )
            )
        );

        return $chart;
    }

    public function get_distinct_payments_years()
    {
        return $this->db->query('SELECT DISTINCT(YEAR(date)) as year FROM tblinvoicepaymentrecords')->result_array();
    }

    public function get_distinct_customer_invoices_years()
    {
        return $this->db->query('SELECT DISTINCT(YEAR(date)) as year FROM tblinvoices WHERE clientid=' . get_client_user_id())->result_array();
    }

    function get_last_row($dbname, $user_id, $client_id){
        $last_row = $this->db->order_by('id',"desc")
                ->where('user_id', $user_id)
                ->where('client_id', $client_id)
                ->limit(1)
                ->get($dbname)
                ->row();
        if (isset($last_row))
            return $last_row;
        return null;
    }
    // create report from tables "cf_global_trade_buysell" & "cf_global_trade_transfer"
    public function  create_reports($user_id, $client_id){
        $buysell_db_name = "cf_global_trade_buysell";
        $transfer_db_name = "cf_global_trade_transfer";
        $disposalhistory_db_name = "cf_disposal_history";
        $acquisition_history_db_name = "cf_acquisition_history";        

        ////////////////////////////////////////////////////////////////////////////////////////////////
        // insert buysell data from cf_global_trade_buysell to cf_disposal_history
        $buysell_data1 = $this->db->query('SELECT * FROM ' . $buysell_db_name . ' WHERE is_disposal = 1 AND user_id='. $user_id . ' AND client_id =' . $client_id)->result_array();        

        foreach ($buysell_data1 as $row) {
            $data = array(
                "user_id"       => $user_id,
                "client_id"     => $client_id,
                "Timestamp"     => $row['Timestamp'],
                "exchange"      => $row['exchange'],
                "trade_action_id"   => $row['trade_action_id'],
                "disp_coincurr"     => $row['sell_coincurr'],
                "disp_amount"       => $row['sell_amount'],
                "disp_value"        => $row['sell_valueinhomecurr']
            );
            // check if already existed
            $result = $this->db->get_where($disposalhistory_db_name, $data)->result();
            if(count($result) > 0){
            }else{
                $last_row = $this->get_last_row($disposalhistory_db_name, $user_id, $client_id);
                if ( isset($last_row)){
                    // get last total value and add disp_value
                    $data['total_dispvalue'] = $last_row->total_dispvalue + $data['disp_value'];
                }else{
                    // if last total value is not existed, then set disp_value to total value
                    $data['total_dispvalue'] = $data['disp_value'];    
                }
                // insert data to db
                $this->db->insert($disposalhistory_db_name, $data);
            }
        }

        // insert disp data from cf_global_trade_transfer to cf_disposal_history
        $transfer_data1 = $this->db->query('SELECT * FROM ' . $transfer_db_name . ' WHERE is_disposal = 1 AND transf_disposal_total < 0 AND user_id='. $user_id . ' AND client_id =' . $client_id)->result_array();

        foreach ($transfer_data1 as $row) {
            $data = array(
                "user_id"       => $user_id,
                "client_id"     => $client_id,
                "Timestamp"     => $row['Timestamp'],
                "exchange"      => $row['exchange'],
                "trade_action_id"   => $row['trade_action_id'],
                "disp_coincurr"     => $row['transf_currency'],
                "disp_amount"       => $row['transf_amount'],
                "disp_value"        => $row['value_homecurr']
            );
            // check if already existed
            $result = $this->db->get_where($disposalhistory_db_name, $data)->result();
            if (count($result) > 0){}
            else{
                $last_row = $this->get_last_row($disposalhistory_db_name, $user_id, $client_id);
                if ( isset($last_row)){
                    $data['total_dispvalue'] = $last_row->total_dispvalue + $data['disp_value'];
                }else{
                    $data['total_dispvalue'] = $data['disp_value'];
                }
                $this->db->insert($disposalhistory_db_name, $data);
            }
        }


        ///////////////////////////////Insert data to cf_acquisition_history////////////////////////////
        //SELECT rows from Cf_global_trade_buysell WHERE buy_coincurr exists in coinlist --> SELECT * FROM cf_global_trade_buysell WHERE buy_coincurr IN (SELECT coin_short FROM cf_coin_list)
        $buysell_data2 = $this->db->query('SELECT * FROM ' . $buysell_db_name . ' WHERE buy_coincurr IN (SELECT coin_short FROM cf_coin_list) AND user_id =' . $user_id . ' AND client_id=' . $client_id)->result_array();

        foreach ($buysell_data2 as $row) {
            $data = array(
                "user_id" => $user_id,
                "client_id" => $client_id,
                "Timestamp" => $row['Timestamp'],
                "trade_action_id" => $row['trade_action_id'],
                "exchange"  => $row['exchange'],
                "acq_amount"   => $row['buy_amount'],
                "acq_coincurr"  => $row['buy_coincurr'],
                "acq_value"     => $row['buy_valueinhomecurr'],
                "fee_homecurr"  => $row['fee_homecurr']
            );
            // check if already existed
            $result = $this->db->get_where($acquisition_history_db_name, $data)->result();
            if (count($result) > 0){}
            else{
                $last_row = $this->get_last_row($acquisition_history_db_name, $user_id, $client_id);
                if ( isset($last_row)){
                    $data['total_acqvalue'] = $last_row->total_acqvalue + $data['acq_value'];
                }else{
                    $data['total_acqvalue'] = $data['acq_value'];
                }
                $this->db->insert($acquisition_history_db_name, $data);
            }
        }

        // insert disp data from cf_global_trade_transfer to cf_disposal_history
        $transfer_data2 = $this->db->query('SELECT * FROM ' . $transfer_db_name . ' WHERE is_disposal = 1 AND transf_disposal_total < 0 AND user_id='. $user_id . ' AND client_id =' . $client_id)->result_array();

        foreach ($transfer_data1 as $row) {
            $data = array(
                "user_id"       => $user_id,
                "client_id"     => $client_id,
                "Timestamp"     => $row['Timestamp'],
                "exchange"      => $row['exchange'],
                "trade_action_id"   => $row['trade_action_id'],
                "acq_coincurr"     => $row['transf_currency'],
                "acq_amount"       => $row['transf_amount'],
                "acq_value"        => $row['value_homecurr'] + $row['fee'],
                "fee_homecurr"  => $row['fee']
            );
            // check if already existed
            $result = $this->db->get_where($acquisition_history_db_name, $data)->result();
            if (count($result) > 0){}
            else{
                $last_row = $this->get_last_row($acquisition_history_db_name, $user_id, $client_id);
                if ( isset($last_row)){
                    $data['total_acqvalue'] = $last_row->total_acqvalue + $data['acq_value'];
                }else{
                    $data['total_acqvalue'] = $data['acq_value'];
                }
                $this->db->insert($acquisition_history_db_name, $data);
            }
        }
    }

    public function creat_gainloss_ledger($user_id, $client_id){
        $dis_db_name = "cf_disposal_history";
        $acq_db_name = "cf_acquisition_history";
        $gainloss_db_name = "cf_gainloss_ledger";
        $coinlist_db_name = "cf_coin_list";        

        $coin_data = $this->db->get($coinlist_db_name)->result_array();
        foreach ($coin_data as $coin) {
            $dis_data = $this->db->query("select * from " . $dis_db_name . " where user_id=" . $user_id . " AND client_id = " . $client_id . " AND disp_coincurr = '" . $coin['coin_short'] . "' ORDER BY Timestamp ASC")->result_array();
            $acq_data = $this->db->query("select * from " . $acq_db_name . " where user_id=" . $user_id . " AND client_id = " . $client_id . " AND acq_coincurr = '" . $coin['coin_short'] . "' ORDER BY Timestamp ASC")->result_array();
            if (count($dis_data) > 0 && count($acq_data) > 0){
                $data = array(
                        "user_id"       => $user_id,
                        "client_id"     => $client_id,
                        "sold_id"       => $dis_data[0]['trade_action_id'],
                        "coincurr"     => $coin['coin_short'],
                        "sold_Timestamp"=> $dis_data[0]['Timestamp'],
                        "sold_amount"   => $dis_data[0]['disp_amount'],
                        "sold_value"    => $dis_data[0]['disp_value'],
                        "cost_id"       => 0,
                        "cost_Timestamp"=> '',
                        "cost_amount"   => 0,
                        "cost_value"    => 0,
                        "cost_fee_value"=> 0,
                        "held_for"      => "",
                        "gain_loss"     => 0
                    );
                $i = 1;
                $j = 0;
                while (1) {
                    if($i >= count($dis_data) || $j >= count($acq_data)) break;
                    if ( $data['sold_amount'] > 0 && $j < count($acq_data)){
                        $cost_amount    = $acq_data[$j]['acq_amount'];
                        $cost_value     = $acq_data[$j]['acq_value'];
                        $cost_ratio     = $cost_value/$cost_amount;
                        $cost_Timestamp = $acq_data[$j]['Timestamp'];
                        $cost_fee_value = $acq_data[$j]['fee_homecurr'];
                        $data['cost_id']= $acq_data[$j]['trade_action_id'];
                        $held_for = date_diff(date_create($data['sold_Timestamp']), date_create($cost_Timestamp));
                        $data['held_for'] = $held_for->days . "days, " . $held_for->h . "h";

                        if ($data['sold_amount'] - $cost_amount > 0 ){
                            // make record to store to db
                            $sold_ratio             = $data['sold_value']/$data['sold_amount'];
                            $sold_remain            = $data['sold_amount'] - $cost_amount;
                            $data['sold_value']     = $sold_ratio * $cost_amount;
                            $data['sold_amount']    = $cost_amount;

                            $data['cost_amount']    = $cost_amount;
                            $data['cost_value']     = $cost_value;
                            $data['cost_Timestamp'] = $cost_Timestamp;
                            $data['cost_fee_value'] = $cost_fee_value;
                            $data['gain_loss']      = $data['sold_value'] - $data['cost_value'] - $data['cost_fee_value'];

                            $this->db->insert($gainloss_db_name, $data);
                            // make record for next calculation
                            $data['sold_amount']    = $sold_remain;
                            $data['sold_value']     = $sold_ratio * $sold_remain;
                            $data['cost_value']     = 0;
                            $data['cost_amount']    = 0;
                            $data['cost_fee_value'] = 0;
                            $data['gain_loss'] = 0;
                        }else{
                            // make record to store to db
                            $cost_remain            = $cost_amount - $data['sold_amount'];
                            $data['cost_amount']    = $data['sold_amount'];
                            $data['cost_value']     = $cost_ratio * $data['sold_amount'];
                            $data['cost_fee_value'] = $cost_fee_value * $data['cost_amount']/$cost_amount;
                            $data['cost_Timestamp'] = $cost_Timestamp;
                            $data['gain_loss']      = $data['sold_value'] - $data['cost_value'] - $data['cost_fee_value'];
                            $this->db->insert($gainloss_db_name, $data);

                            // make record for next calculation
                            $data['cost_amount']    = $cost_remain;
                            $data['cost_value']     = $cost_ratio * $cost_remain;
                            $data['cost_fee_value'] = $cost_fee_value - $data['cost_fee_value'];
                            $data['sold_amount']    = 0;
                            $data['sold_value']     = 0;
                            $data['gain_loss'] = 0;
                        }
                        $j = $j + 1;
                    }else{
                        if ($i < count($dis_data)){
                            $sold_amount    = $dis_data[$i]['disp_amount'];
                            $sold_value     = $dis_data[$i]['disp_value'];
                            $sold_Timestamp = $dis_data[$i]['Timestamp'];
                            $sold_id        = $dis_data[$i]['trade_action_id'];
                            $sold_ratio     = $sold_value / $sold_amount;
                            $data['sold_id']= $dis_data[$i]['trade_action_id'];
                            $held_for = date_diff(date_create($sold_Timestamp), date_create($data['cost_Timestamp']));
                            $data['held_for'] = $held_for->days . "days, " . $held_for->h . "h";

                            if ($data['cost_amount'] - $sold_amount > 0 ){
                                $cost_ratio             = $data['cost_value'] / $data['cost_amount'];
                                $cost_remain            = $data['cost_amount'] - $sold_amount;
                                $cost_fee_remain        = $data['cost_fee_value'] / $data['cost_amount'] * $cost_remain;
                                $data['cost_fee_value'] = $data['cost_fee_value'] - $cost_fee_remain;
                                $data['cost_amount']    = $sold_amount;
                                $data['cost_value']     = $cost_ratio * $sold_amount;

                                $data['sold_amount']    = $sold_amount;
                                $data['sold_value']     = $sold_value;
                                $data['sold_Timestamp'] = $sold_Timestamp;
                                $data['gain_loss']      = $data['sold_value'] - $data['cost_value'] - $data['cost_fee_value'];
                                $this->db->insert($gainloss_db_name, $data);

                                // make record for next calculation
                                $data['cost_amount']    = $cost_remain;
                                $data['cost_fee_value'] = $cost_fee_remain;
                                $data['cost_value']     = $cost_ratio * $cost_remain;
                                $data['sold_amount']    = 0;
                                $data['sold_value']     = 0;
                                $data['gain_loss']      = 0;
                            }else{
                                $sold_ratio = $sold_value / $sold_amount;
                                $sold_remain = $sold_amount - $data['cost_amount'];

                                $data['sold_amount'] = $data['cost_amount'];
                                $data['sold_value']  = $sold_ratio * $data['cost_amount'];
                                $data['sold_Timestamp'] = $sold_Timestamp;
                                $data['gain_loss']      = $data['sold_value'] - $data['cost_value'] - $data['cost_fee_value'];
                                $this->db->insert($gainloss_db_name, $data);

                                // make record for next calculation
                                $data['cost_amount']    = 0;
                                $data['cost_value']     = 0;
                                $data['cost_fee_value'] = 0;
                                $data['sold_amount']    = $sold_remain;
                                $data['sold_value']     = $sold_ratio * $sold_remain;
                                $data['gain_loss'] = 0;
                            }
                            $i = $i + 1;
                        }                    
                    }
                }
            }
        }
                  
    }
}































/*
    public function creat_gainloss_ledger($user_id, $client_id){
        $dis_db_name = "cf_disposal_history";
        $acq_db_name = "cf_acquisition_history";
        $gainloss_db_name = "cf_gainloss_ledger";
        $coinlist_db_name = "cf_coin_list";        

        $coin_data = $this->db->get($coinlist_db_name)->result_array();
        foreach ($coin_data as $coin) {
            $dis_data = $this->db->query("select * from " . $dis_db_name . " where user_id=" . $user_id . " AND client_id = " . $client_id . " AND disp_coincurr = '" . $coin['coin_short'] . "' ORDER BY Timestamp ASC")->result_array();
            $acq_data = $this->db->query("select * from " . $acq_db_name . " where user_id=" . $user_id . " AND client_id = " . $client_id . " AND acq_coincurr = '" . $coin['coin_short'] . "' ORDER BY Timestamp ASC")->result_array();
            $data = array();
            $sold_batch_rem = 0;

            if(count($dis_data)>0 && count($acq_data)>0){
                $i = 0; $j = 0;
                $data = array(
                        "user_id"       => $user_id,
                        "client_id"     => $client_id,
                        "coincurr"      => $acq_data[$i]['acq_coincurr'],
                        "cost_id"       => $acq_data[$i]['trade_action_id'],
                        "cost_Timestamp"=> $acq_data[$i]['Timestamp'],
                        "cost_amount"   => $acq_data[$i]['acq_amount'],
                        "cost_value"    => $acq_data[$i]['acq_value'],
                        "sold_amount"   => 0,
                        "sold_value"    => 0,
                        "cost_batch_rem"=> $acq_data[$i]['acq_amount'],
                        "cost_fee_value"=> 0,
                        "fee_batch_rem" => 0,
                        "held_for"      => '',
                        "gain_loss"     => 0,
                    );
                $cost_ratio = $data['acq_value']/$data['acq_amount'];;
                $sold_ratio = 0;

                while ($i < count($acq_data) - 1  && $j < count($dis_data)) {

                    if ($data['cost_batch_rem'] > 0){
                        $data['sold_id'] = $dis_data[$j]['trade_action_id'];
                        $data['sold_amount'] = $dis_data[$j]['disp_amount'];
                        $data['sold_value'] = $dis_data[$j]['disp_value'];
                        $data['sold_Timestamp'] = $dis_data['Timestamp'];                        
                        $cost_batch_rem  = $data['cost_batch_rem'] - $data['sold_amount'];
                        $sold_ratio = $dis_data[$j]['disp_value']/$dis_data[$j]['disp_amount'];
                        $j = $j + 1;
                    }else{                        
                        $i = $i + 1;
                        $data['cost_id'] = $acq_data[$i]['trade_action_id'];
                        $data['cost_amount'] = $acq_data[$i]['acq_amount'];
                        $data['cost_value'] = $acq_data[$i]['acq_value'];
                        $data['cost_Timestamp'] = $acq_data[$i]['Timestamp'];
                        $data['cost_fee_value'] = $acq_data[$i]['fee_homecurr'];
                        // add cost_amount to cost_batch_rem
                        $cost_batch_rem  = $data['cost_batch_rem'] + $data['cost_amount'];
                        $cost_ratio = $acq_data[$i]['acq_value']/$acq_data[$i]['acq_amount'];
                    }
                    
                    // set sold_amount and cost_amount the same
                    $data['cost_batch_rem'] = $cost_batch_rem;
                    if ($cost_batch_rem <= 0){
                        $data['sold_amount'] = $data['cost_amount'];
                        $data['sold_value'] = $sold_ratio * $data['sold_amount'];
                    }else{
                        $data['cost_amount'] = $data['sold_amount'];
                        $data['cost_value'] = $cost_ratio * $data['cost_amount'];
                    }
                    // get gain_loss
                    $data['gain_loss']  = $data['cost_value'] - $data['sold_value'];
                    // get differece from two timestamps
                    $held_for = date_diff(date_create($data['sold_Timestamp']), date_create($data['cost_Timestamp']));
                    $data['held_for'] = $held_for->days . "days, " . $held_for->h . "h";
                    $this->db->insert($gainloss_db_name,$data);
                }
            }
        }        
    }
*/