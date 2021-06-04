INSERT IGNORE INTO `permission` (`name`, `code`, `description`) VALUES
('Add New User', 'ad_usr', 'Register New User To The System'),
('Edit User', 'edt_usr', 'Edit User Information'),
('Delete User', 'dlt_usr', 'Remove User From The System'),
('Add User To User Group', 'ad_usr_t_grp', 'Give Privileges to User'),
('Add New User Group', 'ad_usr_grp', 'Create New User Group'),
('Edit User Group', 'edt_usr_grp', 'Edit User Group'),
('Delete User Group', 'dlt_usr_grp', 'Remove User Group'),
('Add Permission To User Group', 'ad_prmsn_t_grp', 'Add Permission To User Group'),
('View User List', 'vw_usr_lst', 'View User List'),
( 'View User Detail', 'vw_usr_dtl', 'View User Detail'),
( 'View User Group', 'vw_usr_grp', 'View User Group'),
( 'Reset User Password', 'rst_pswd', 'Reset User Password'),

-- goal
( 'Register New Goal', 'ad_gol', 'Register new goal'),
( 'Edit Goal', 'edt_gol', 'Edit Goal'),
( 'View Goal', 'vw_gol', 'View goal'),
( 'View  Goal Detail', 'vw_gol_dtl', 'View  Goal Detail '),
( 'Delete Goal ', 'dlt_gol', 'Delete Goal'),
( 'Deactivate Goal', 'deact_gol', 'Deactivate Goal'),
( 'Activate Goal', 'act_gol', 'Activate Goal'),

-- Perspective
( 'Register New Perspective', 'ad_per', 'Register new Perspective'),
( 'Edit Perspective', 'edt_per', 'Edit Perspective'),
( 'View Perspective', 'vw_per', 'View Perspective'),
( 'View  Perspective Detail', 'vw_per_dtl', 'View  Perspective Detail '),
( 'Delete Perspective ', 'dlt_per', 'Delete Perspective'),
( 'Deactivate Perspective', 'deact_per', 'Deactivate Perspective'),
( 'Activate Perspective', 'act_per', 'Activate Perspective'),

-- Objective
( 'Register New Objective', 'ad_objt', 'Register new Objective'),
( 'Edit Objective', 'edt_objt', 'Edit Objective'),
( 'View Objective', 'vw_objt', 'View Objective'),
( 'View  Objective Detail', 'vw_objt_dtl', 'View  Objective Detail '),
( 'Delete Objective ', 'dlt_objt', 'Delete Objective'),
( 'Deactivate Objective', 'deact_objt', 'Deactivate Objective'),
( 'Activate Objective', 'act_objt', 'Activate Objective'),

--Strategy
( 'Register New Strategy', 'ad_str', 'Register new Strategy'),
( 'Edit Strategy', 'edt_str', 'Edit Strategy'),
( 'View Strategy', 'vw_str', 'View Strategy'),
( 'View  Strategy Detail', 'vw_str_dtl', 'View  Strategy Detail '),
( 'Delete Strategy ', 'dlt_str', 'Delete Strategy'),
( 'Deactivate Strategy', 'deact_str', 'Deactivate Strategy'),
( 'Activate Strategy', 'act_str', 'Activate Strategy'),

-- Kpi
( 'Register New KPI', 'ad_kpi', 'Register new KPI'),
( 'Edit KPI', 'edt_kpi', 'Edit KPI'),
( 'View KPI', 'vw_kpi', 'View KPI'),
( 'View  KPI Detail', 'vw_kpi_dtl', 'View  KPI Detail '),
( 'Delete KPI ', 'dlt_kpi', 'Delete KPI'),
( 'Deactivate KPI', 'deact_kpi', 'Deactivate KPI'),
( 'Activate KPI', 'act_kpi', 'Activate KPI'),

-- Initiatives
( 'Register New Initiative', 'ad_intv', 'Register new Initiative'),
( 'Edit Initiative', 'edt_intv', 'Edit Initiative'),
( 'View Initiative', 'vw_intv', 'View Initiative'),
( 'View  Initiative Detail', 'vw_intv_dtl', 'View  Initiative Detail '),
( 'Delete Initiative ', 'dlt_intv', 'Delete Initiative'),
( 'Deactivate Initiative', 'deact_intv', 'Deactivate Initiative'),
( 'Activate Initiative', 'act_intv', 'Activate Initiative'),
('View Suitable Initiative','vw_suit_intv','View Suitable Initiative')

-- Principal Office

( 'Register New Principal Office', 'ad_pof', 'Register new Principal Office'),
( 'Edit Principal Office', 'edt_pof', 'Edit Principal Office'),
( 'View Principal Office', 'vw_pof', 'View Principal Office'),
( 'View  Principal Office Detail', 'vw_pof_dtl', 'View  Principal Office Detail '),
( 'Delete Principal Office ', 'dlt_pof', 'Delete Principal Office'),
( 'Deactivate Principal Office', 'deact_pof', 'Deactivate Principal Office'),
( 'Activate Principal Office', 'act_pof', 'Activate Principal Office'),

-- Operational  Office

( 'Register New Operational Office', 'ad_opof', 'Register new Operational Office'),
( 'Edit Operational Office', 'edt_opof', 'Edit Operational Office'),
( 'View Operational Office', 'vw_opof', 'View Operational Office'),
( 'View  Operational Office Detail', 'vw_opof_dtl', 'View  Operational Office Detail '),
( 'Delete Operational Office ', 'dlt_opof', 'Delete Operational Office'),
( 'Deactivate Operational Office', 'deact_opof', 'Deactivate Operational Office'),
( 'Activate Operational Office', 'act_opof', 'Activate Operational Office'),
-- performer
( 'Add New Performer', 'ad_prfm', 'Register new Performer'),
( 'Edit Performer', 'edt_prfm', 'Edit Performer'),
( 'View Performer', 'vw_prfm', 'View Performer'),
( 'View  Performer Detail', 'vw_prfm_dtl', 'View  Performer Detail '),
( 'Delete Performer ', 'dlt_prfm', 'Delete Performer'),
( 'Deactivate Performer', 'deact_prfm', 'Deactivate Performer'),
( 'Activate Performer', 'act_prfm', 'Activate Performer'),

-- Operational Manager

( 'Add New Operational Manager', 'ad_opr_mng', 'Register new Operational Manager'),
( 'Edit Operational Manager', 'edt_opr_mng', 'Edit Operational Manager'),
( 'View Operational Manager', 'vw_opr_mng', 'View Operational Manager'),
( 'View  Operational Manager Detail', 'vw_opr_mng_dtl', 'View  Operational Manager Detail '),
( 'Delete Operational Manager ', 'dlt_opr_mng', 'Delete Operational Manager'),
( 'Deactivate Operational Manager', 'deact_opr_mng', 'Deactivate Operational Manager'),
( 'Activate Operational Manager', 'act_opr_mng', 'Activate Operational Manager'),

-- Principal Manager

( 'Add New Principal Manager', 'ad_pr_mng', 'Register new Principal Manager'),
( 'Edit Principal Manager', 'edt_pr_mng', 'Edit Principal Manager'),
( 'View Principal Manager', 'vw_pr_mng', 'View Principal Manager'),
( 'View  Principal Manager Detail', 'vw_pr_mng_dtl', 'View  Principal Manager Detail '),
( 'Delete Principal Manager ', 'dlt_pr_mng', 'Delete Principal Manager'),
( 'Deactivate Principal Manager', 'deact_pr_mng', 'Deactivate Principal Manager'),
( 'Activate Principal Manager', 'act_pr_mng', 'Activate Principal Manager'),

-- Initiative Behaviour
( 'Add New Initiative Behaviour', 'ad_intv_bvr', 'Register new Initiative Behaviour'),
( 'Edit Initiative Behaviour', 'edt_intv_bvr', 'Edit Initiative Behaviour'),
( 'View Initiative Behaviour', 'vw_intv_bvr', 'View Initiative Behaviour'),
( 'View  Initiative Behaviour Detail', 'vw_intv_bvr_dtl', 'View  Initiative Behaviour Detail '),
( 'Delete Initiative Behaviour ', 'dlt_intv_bvr', 'Delete Initiative Behaviour'),
( 'Deactivate Initiative Behaviour', 'deact_intv_bvr', 'Deactivate Initiative Behaviour'),
( 'Activate Initiative Behaviour', 'act_intv_bvr', 'Activate Initiative Behaviour'),

-- Initiative Attribute
( 'Add New Initiative Attribute', 'ad_intv_atr', 'Register new Initiative Attribute'),
( 'Edit Initiative Attribute', 'edt_intv_atr', 'Edit Initiative Attribute'),
( 'View Initiative Attribute', 'vw_intv_atr', 'View Initiative Attribute'),
( 'View  Initiative Attribute Detail', 'vw_intv_atr_dtl', 'View  Initiative Attribute Detail '),
( 'Delete Initiative Attribute ', 'dlt_intv_atr', 'Delete Initiative Attribute'),
( 'Deactivate Initiative Attribute', 'deact_intv_atr', 'Deactivate Initiative Attribute'),
( 'Activate Initiative Attribute', 'act_intv_atr', 'Activate Initiative Attribute'),

-- Planning year
( 'Add New Planning Year', 'ad_pln_yr', 'Register new Planning Year'),
( 'Edit Planning Year', 'edt_pln_yr', 'Edit Planning Year'),
( 'View Planning Year', 'vw_pln_yr', 'View Planning Year'),
( 'View  Planning Year Detail', 'vw_pln_yr_dtl', 'View  Planning Year Detail '),
( 'Delete Planning Year ', 'dlt_pln_yr', 'Delete Planning Year'),
( 'Deactivate Planning Year', 'deact_pln_yr', 'Deactivate Planning Year'),
( 'Activate Planning Year', 'act_pln_yr', 'Activate Planning Year'),

-- planning Report Announcement

( 'Add New Planning Report Announcement', 'ad_pln_rpt', 'Register new Planning Report Announcement'),
( 'Edit Planning Report Announcement', 'edt_pln_rpt', 'Edit Planning Report Announcement'),
( 'View Planning Report Announcement', 'vw_pln_rpt', 'View Planning Report Announcement'),
( 'View  Planning Report Announcement Detail', 'vw_pln_rpt_dtl', 'View  Planning Report Announcement Detail '),
( 'Delete Planning Report Announcement ', 'dlt_pln_rpt', 'Delete Planning Report Announcement'),
( 'Deactivate Planning Report Announcement', 'deact_pln_rpt', 'Deactivate Planning Report Announcement'),
( 'Activate Planning Report Announcement', 'act_pln_rpt', 'Activate Planning Report Announcement'),

-- Report Quarter

( 'Add New Report Quarter', 'ad_rpt_qrt', 'Register new Report Quarter'),
( 'Edit Report Quarter', 'edt_rpt_qrt', 'Edit Report Quarter'),
( 'View Report Quarter', 'vw_rpt_qrt', 'View Report Quarter'),
( 'View  Report Quarter Detail', 'vw_rpt_qrt_dtl', 'View  Report Quarter Detail '),
( 'Delete Report Quarter ', 'dlt_rpt_qrt', 'Delete Report Quarter'),
( 'Deactivate Report Quarter', 'deact_rpt_qrt', 'Deactivate Report Quarter'),
( 'Activate Report Quarter', 'act_rpt_qrt', 'Activate Report Quarter');






 



