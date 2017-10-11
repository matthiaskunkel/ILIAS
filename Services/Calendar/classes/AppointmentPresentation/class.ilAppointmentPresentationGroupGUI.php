<?php
include_once './Services/Calendar/interfaces/interface.ilCalendarAppointmentPresentation.php';
include_once './Services/Calendar/classes/AppointmentPresentation/class.ilAppointmentPresentationGUI.php';

/**
 *
 * @author Jesús López Reyes <lopez@leifos.com>
 * @version $Id$
 *
 * @ilCtrl_IsCalledBy ilAppointmentPresentationGroupGUI: ilCalendarAppointmentPresentationGUI
 *
 * @ingroup ServicesCalendar
 */
class ilAppointmentPresentationGroupGUI extends ilAppointmentPresentationGUI implements ilCalendarAppointmentPresentation
{

	public function collectPropertiesAndActions()
	{
		include_once "./Modules/Group/classes/class.ilObjGroup.php";

		$a_app = $this->appointment;

		$this->lng->loadLanguageModule("grp");

		$cat_info = $this->getCatInfo();

		$grp = new ilObjGroup($cat_info['obj_id'], false);

		$refs = ilObject::_getAllReferences($cat_info['obj_id']);
		$grp_ref_id = current($refs);

		// add common section (title, description, object/calendar, location)
		$this->addCommonSection($a_app, $cat_info['obj_id']);

		if($grp->getInformation())
		{
			$this->addInfoSection($this->lng->txt("cal_grp_info"));
			$this->addInfoProperty($this->lng->txt("grp_information"), ilUtil::makeClickable(nl2br($grp->getInformation())));
		}

		$this->addAction($this->lng->txt("grp_grp_open"), ilLink::_getStaticLink($grp_ref_id, "grp"));
	}

}