<?php

class RichestPeople extends Controller
{
	private $richestPersonModel;

	public function __construct()
	{
		$this->richestPersonModel = $this->model('RichestPerson');
	}

	public function index()
	{
		// haalt de gegevens uit de database via the model
		$record = $this->richestPersonModel->getRichestPeople();

		$rows = '';
		foreach ($record as $value) {
			$rows .= "<tr>
							<td>$value->Name</td>
							<td>$value->Networth</td>
							<td>$value->MyAge</td>
							<td>$value->Company</td>
							<td><a href='" . URLROOT . "/richestPeople/delete/$value->Id'>delete</a></td>
					</tr>";
		}

		// data die wordt doorgestuurd naar de view
		$data = [
			"title" => "De vijf rijkste mensen ter wereld",
			"rows" => $rows
		];
		$this->view("richestPeople/index", $data);
	}

	public function delete($id)
	{
		// echo $id;
		$this->richestPersonModel->deleteRichestPerson($id);

		$data = [
			'deleteStatus' => "Het record is succesvol verwijdert"
		];

		$this->view("richestPeople/delete", $data);
		header('Refresh:2; url=' . URLROOT . '/richestPeople/index');
	}
}
