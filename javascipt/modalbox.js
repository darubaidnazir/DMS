$(document).ready(function () {
  $(".director").animate({width: "95%"},1000);
 
  $("#carouselExampleDark").animate({width: "90%"},700);
    $("#readmore_director").click(function () {
      disable() ;
      $("#modal_heading").text("Message From Director");
      $("#modal_body").text("In the State of J & K, the higher education sector has expanded over the last decade to the extent that colleges and university campuses have come up in the nook and corner of the state. Where it has made higher education accessible to all sections of the society but this has been at the cost of quality of education offered.Though new and market friendly courses are offered in many institutions of higher learning now, yet the supply of skilled manpower is not as per demand in the society. This is a serious issue that needs to be addressed.North campus, University of Kashmir, at present, offers four programmes of study, all of which are market friendly and have lot of potential in the job market of the country. We are in the process of offering more such courses as have a large job potential and are not offered elsewhere in the valley at least. For this purpose the campus needs infrastructural development at a fast pace and it is heartening to note that the decision makers are live to this issue. The biggest asset of the campus is its dedicated and learned faculty and ever enthusiastic students. We are contemplating a shift in the teaching-learning process from the next session and are also initiating healthy practices from the next academic session. Our aim is to develop all the faculties in our scholars and make them proud citizens of the state. Sports activities, debates, seminars, guest lectures, workshops have to be a hallmark of the campus that will enhance self confidence and self esteem among our students.The campus aims to provide accommodation to all desirous students as also the faculty and preparations are afoot in this direction with the commissioning of two hostels- for boys and girls each at the Delina ghat site of the campus. National service scheme is expected to get a boost from the next session and village adoption is on cards. Outreach programmes shall be initiated especially by the Management department to take the fruits of knowledge to general populace. It is hoped that with the cooperation of all stake holders, North campus of Kashmir University will eventually become a center of excellence in some core areas of studies and students from far flung areas shall feel proud to be a part of this institution of higher learning.");
      $(".modal").css("display","block");
      

    });
    $("#readmore_cse").click(function () {
      disable() ;
      $("#modal_heading").text("The Department of Computer Science and Engineering");
      var stringmessage = "One of the biggest advantages of the department is the strength of permanent faculty members. With six assistant professors assisted by as many contractual teachers, the department strives to maintain highest academic standards by putting in place best practices for ensuring smooth and efficient functioning of academics. Teaching-learning is systematic with an up-to-date curriculum. The major focus remains towards laboratory experiments and hands-on learning. Quality is stressed though standard mechanisms of monitoring and student feedback.We believe in overall development of students and hence prime importance is given to student mentoring through regular counselling and interactions. Many batches have passed out with a significant number of students being absorbed in reputed industries and many others pursuing higher degrees like Ph.D in foreign universities.We have recently conceived an innovative program called ‘Achievers Meet Aspirers’, which consists of guest lectures and interactive sessions by passed out students of our own department currently employed in the corporate IT sector. This is aimed at providing exposure and motivation to our graduating students. This year (2021), the department took a big step towards expansion with the commencement of M. Tech CSE programme which will provide great opportunity to candidates to pursue the said degree which is not yet offered in any other institution of the valley. ";
      stringmessage += '<h3>Infrastructure</h3>';
      stringmessage += "The Department of Computer Science & Engineering consists of abundant and modern infrastructure that caters well to the curriculum needs of both the programmes offered i.e B.Tech CSE and M.Tech CSE. There is a setup of wide range of software and hardware resources to support the educational and research mission of the department. All the various equipment housed by the laboratories are of the highest quality/configuration. The following software/hardware resources are currently available:";
      stringmessage += '<h3>Computer Labs:</h3>';
      stringmessage += "There are three capacious and fully networked computer labs consisting of modern desktop/All-in-one machines. All the three labs are ICT enabled with overhead projectors (OHPs) and ACs installed. ";
      stringmessage += '<h3>System Development & Innovation Lab: </h3>';
      stringmessage += "The department has developed a special System Development & Innovation lab housing high-end desktop systems, microcontroller boards and kits that facilitates students to carry out project work and develop innovative solutions.";
      stringmessage += '<h3>Electronics & Communication/ Hardware Labs:</h3>';
      stringmessage += "The department consists of Electronics & Communication (E&C) and Hardware labs which include Digital Design Lab., Communication Lab, Digital Signal Processing Lab and Microprocessor Lab. These have all necessary apparatus in place including equipment like CRO, DSO, digital multimeter, power supplies, etc. and various kits/trainers viz. NV6513, ST2201, ST2202, etc. The said labs are also equipped with simulators like MATLAB, Logisim, LTspice, SPICE for electronic circuit simulation. ";
      stringmessage += '<h3>SOFTWARE:</h3>';
      stringmessage += "<b>Programming/Algorithms and Software Development:</b> Code block, Dev C++, Turbo C++, Jupyter Notebook, JDK, XAMPP, Visual Studio Code, SASS, Jquery, PHP etc.";
      stringmessage += "<br><b>Data Science and Artificial Intelligence:</b> Anaconda, MATLAB, Tableu, SPSS.";
      stringmessage += "<br><b>Networking: </b>Cyber Security, and Cloud Computing: Cisco packet tracer, NetSim, NS2, NS3, Kali Linux, Wireshark, Vmware, Qemu, etc. alongwith networking devices like routers, hubs, switches. ";
      stringmessage += "<br><b>High Performance Computing Lab:</b> The department has also set up a High Performance Computing lab that is equipped with highly optimized and scalable servers (with dedicated GPUs) capable of processing high workloads characteristic of areas such as artificial intelligence, data sciences and natural language/image processing. The said lab also houses an interactive flat panel display (IFPD) along with other ICT accessories which makes it truly state-of-the-art. The lab will be fully functional from Dec- 2021. ";
      stringmessage += "<br><b>Applied Sciences Labs:</b> The applied sciences labs include labs for Physics and Chemistry. Both the labs are well equipped with basic infrastructure for conducting various experiments for the first-year students of B. Tech CSE. There is a dedicated Physics lab housing all essential equipment that provides a platform for experimentation and analysis. These include equipment such as Biot Savart’s Law, Wheatstone Bridge, Biprism apparatus, etc.";
      
      stringmessage += "<br><b>Library:</b> The central library of the campus houses hundreds of books which include titles pertaining to core computer engineering and applied science subjects from reputed publishers such as Mc Graw Hill, Pearson, Wiley,etc. Further, books for competitive examinations like GATE, UGC-NET, etc. are available."
      stringmessage += "<h3>Vision</h3>";
      stringmessage += "To transform students into good human beings, competent and responsible professionals, with focus on excellence in Education, Research and Technological development so that they can better serve the nation."
      stringmessage += "<h3>Important Contacts <i>(for queries related to classwork, admission etc):</i></h3>"
      stringmessage += "Er. Khalid Hussain, Coordinator : +91-6005088890 <br>Mr. Ishfaq Ahmad, Dealing Assistant : +91-7006001523 <br>Email id: csenc@uok.edu.in"
      $("#modal_body").html(stringmessage);
      
      $(".modal").css("display","block");
      

    });
    $(".close").click(function () {
      enable();
      $(".modal").css("display","none");
    });
    $("#readmore_mca").click(function () {
      disable() ;
        $("#modal_heading").text("P.G Department of Computer Science");
        $("#modal_body").html("<h3>About Us</h3> The P.G. Department of Computer Sciences and Applications at the North Campus, University of Kashmir is ambitious to organize and chisel the talents of the students and has been doing the best to develop the resource of the country in general and the state in particular since its inception in 2003 as a P.G. Center housed at Government Degree College Baramulla. The aim of education at North Campus is to enable students to acquire specialized scientific knowledge, as well as provide a basis for their personal, social and cognitive development. <h3>Infrastructure</h3>The P.G Department of Computer Sciences is well equipped with two state-of art computer laboratories, housing about 50 computer systems, out of which about 30 are latest ALL-IN-ONE. Besides the Department has a very good internet connectivity both LAN and Wi-Fi enabled. The Department has one latest Duplex Photostat machine for student services. The Department has a rich book collection of latest titles on Computer science and allied fields.<h3> Vision</h3>The P. G. Department of Computer Sciences produces highly competent computer professionals through highly competent and experienced staff, both teaching & non-teaching, and state-of-art computer laboratories.");
        $(".modal").css("display","block");
        
  
      });

      $("#readmore_imba").click(function () {
        disable() ;
        $("#modal_heading").text("Department of Management Studies");
        $("#modal_body").html("<h3>About Us</h3> The Department of Management Studies, North Campus University of Kashmir came into being in the year 2012. It aims at enhancing the understanding of the students about the subject matter of business and management. The department prides itself in being an amalgam of dynamism and academic excellence. The Department of Management Studies has presently four batches enrolled for its Integrated MBA Programme. The department aims to create and disseminate business knowledge that transforms the lives of our students by leveraging our advantages for the benefit of our student community.<h3>Infrastructure</h3>The department has at present 4 classrooms, 4 faculty rooms and 2 washrooms. Besides, a computer lab is in the process of being developed.<h3> Vision</h3>To strive to be a renowned business school focused on leadership, innovation and entrepreneurship by creating an exceptional student-centric academic environment.");
        $(".modal").css("display","block");
        
  
      });
      $("#readmore_aboutnc").click(function () {
        disable() ;
        $("#modal_heading").text("About North Campus");
        var more = "these remote areas by enhancing their intellectual, academic and cultural development through education. The Campus has envisioned excelling and growing in its strength, manpower and other potentialities for realizing its long cherished dream of earning a lasting place on the academic map of the University of Kashmir in the forthcoming years. At this backdrop, new Post graduate courses, Engineering courses and job and skill based diploma courses are proposed to be launched in the next five year plan period."
        $("#modal_body").text("The North Campus of the University of Kashmir, Delina, Baramulla was conceived to be set up in 2002 when it was realized that the present campus of University of Kashmir may at best accommodate 7% to 9% applicants for its programs and therefore need to increase enrollment ratio in higher education in tune with the national average. In May, 2002, a one-time grant of Rs. 5.95 crores was sanctioned by the UGC in favor of the University under PM’s Package for the establishment of satellite campuses at Baramulla and Anantnag. This was followed by the transfer of 350 kanals (44 Acres) of land by the State to the University at Lower Delina, Baramulla in 2003 and subsequent transfer of 275 kanals (35 Acres) of land by the State to the University at Upper Delina, Baramulla 2005.However construction of Science Block, B.Tech Block & Administrative Block was taken up at upper Delina which is at a ridge top and is about 150 feet above the ground level of Delina, Baramulla. The North Campus of the University of Kashmir was formally made operational from 2009 at upper Delina, Baramulla. Initially, two programmes – Masters in Computer Applications (MCA) and B. Tech in Computer Science and Engineering were launched which was followed by M.A English. Five years (BBA+MBA) Integrated Masters Programme in Business Administration (IMBA) was launched from June-July 2012. The two post graduate diploma programs which have also been already approved are PG Diploma in Tourism Management and PG Diploma in Non-Conventional Energy shall also be subsequently started once the required infrastructure is put in place. Currently, there are five structures – Administrative Block which has six office type rooms, B.Tech Block having six classrooms cum labs and eight faculty rooms, Science Block that has also six classrooms cum labs and eight faculty rooms, IMBA block having four classrooms with equal number of faculty rooms and a library block which houses the library – on the upper Delina Campus. The campus focuses presently on Job- oriented professional and non professional courses with the motto to provide access to the people living in these distant areas to higher education by making them to prepare a diverse community of learners who could demonstrate a global perspective. By opening this Campus, the University has paid special attention to the improvement of social and economic conditions and welfare of the people dwelling in"+ more);
       
        $(".modal").css("display","block");
        
  
      });
      $("#readmore_mission").click(function () {
        disable() ;
        $("#modal_heading").text("Mission");
        $("#modal_body").html("The Campus strives to achieve the status of being a Mini-University by 2025 with a major focus on Technical/Professional and Job-Oriented courses.In line with the vision and mission, there is a well delineated program of launching courses in a phased manner:<h3>PHASE I ( 2010-2012) Completed</h3>Master of Computer Sciences (MCA)<br> B-Tech CSE<br>5-year Integrated Masters Program in Business Administration (IMBA)<br><h3>PHASE II (2012-2015) In Progress</h3> Masters in English [Launched in 2013]<br> Master of Travel & Tourism<br> Diploma in Non-Conventional Energy<br><h3>PHASE III (2016-2020) Target</h3> B.Tech Electrical<br>B.Tech Electronics & Communication<br>B.Tech Mechanical<br> M.Sc Information Technology<br>P.G Diploma in Computer Applications(PGDCA)<br>Masters in Applied Mathematics<br>Masters in Physics<br>Masters in Electronics<br>Masters in Chemistry<br><h3>PHASE IV (2021-2025/2030) Target</h3> Masters in Microbiology<br>Masters in Biotechnology<br>Masters in Bio-informatics<br> Masters in Robotics<br> Bachelors and Masters in Pharmacy<br> Masters in Nanotechnology<br>Masters in Femto-Chemistry<br>Masters in Embedded Systems<br> Masters in Quantum Computing<br>Masters in Green technology<br>Masters in Distributed Computing<br>Masters in Bio-Mathematics<br>Masters in Industrial-Chemistry<br>Masters in Communication Technologies<br> Masters in Education (M. A. Education)<br>5-year Integrated Masters Program in Advanced Medical Lab. Technology<br>Executive Program in Business administration<br> Masters in Green-Chemistry<br>Masters in Botany<br>Masters in Zoology<br> Masters in Geology and Geo-Physics");
        $(".modal").css("display","block");
        
  
      });


     

  });
  function disable() {
    // To get the scroll position of current webpage
    TopScroll = window.pageYOffset || document.documentElement.scrollTop;
    LeftScroll = window.pageXOffset || document.documentElement.scrollLeft,
    
    // if scroll happens, set it to the previous value
    window.onscroll = function() {
    window.scrollTo(LeftScroll, TopScroll);
            };
    }
    
    function enable() {
    window.onscroll = function() {};
    }
