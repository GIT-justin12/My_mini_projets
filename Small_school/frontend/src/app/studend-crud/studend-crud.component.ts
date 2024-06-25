import { HttpClient } from '@angular/common/http';
import { Component } from '@angular/core';

@Component({
  selector: 'app-studend-crud',
  templateUrl: './studend-crud.component.html',
  styleUrl: './studend-crud.component.scss'
})
export class StudendCrudComponent {
  studentArray: any[] = [];
  isResultLoaded = false;
  isUpdateFormActive = false;

  stname: string ="";
  course: string ="";
  fee: string ="";
  currentStudentID = "";

  constructor(private http: HttpClient) {
    this.getAllStudent();
  }
  
  ngOnInit(): void {
  }
  
  getAllStudent() {
    this.http.get("http://localhost:3000/api/student/")
    .subscribe((resultData: any)=>
    {
      this.isResultLoaded = true;
      console.log(resultData.data);
      this.studentArray = resultData.data;
    });
  }  
}