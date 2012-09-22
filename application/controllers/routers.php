<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class routers extends CI_Controller {
	public function startpage() {
		$this->load->view('startpage');
	} public function oldStartpage() {
		$this->load->view("oldStartpage");
	} public function dashboard() {
		$this->load->view('dashboard');
	} public function register() {
		$this->load->view('member-register');
	} public function register_church() {
		$this->load->view('register-church');
	} public function search_aChurch() {
		$this->load->view('search_aChurch');
	} public function wall_1() {
		$this->load->view('wall-1');
	} public function loadMorePosts() {
		$this->load->view('reg-user/loadMorePosts');
	} public function regUserDash() {
		$this->load->view("reg-user/dashboard");
	} public function userProfiles() {
		$this->load->view("userProfiles");
	} public function addUpdateUserInfo() {
		$this->load->view("addUpdateUserInfo");
	} public function viewMyWall_userProfiles() {
		$this->load->view("userProfiles");
	} public function viewInfoSlider() {
		$this->load->view("viewMyInfoSlider");
	} public function addEditUserInfoSlider() {
		$this->load->view("addEditUserInfoSlider");
	} public function viewUserProfileAblumsSlider() {
		$this->load->view("userProfilePhotoAlbums");
	} public function updateProfileImgRegUserRegister() {
		$this->load->view('updateProfileImgRegUserRegister');
	} public function ajaxMore() {
		$this->load->view('ajaxMore');
	}
}