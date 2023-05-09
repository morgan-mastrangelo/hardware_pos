export class Employee {
    constructor(name, salary) {
      this.name = name;
      this.salary = salary;
    }
  
    increaseSalary() {
      this.salary += 100;
    }
  }