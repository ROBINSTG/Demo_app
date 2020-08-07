/**
* author: Robin St-Georges date: 2020-08-06
* Simple demo project realized with the goal to show understanding of PHP, Javascript & co.
*
* main: small algorithm used to find which row has been selected for deletion.
*/

const submissions = document.getElementById('submissions');

if(submissions) {
    submissions.addEventListener('click', e => {
        if(e.target.className === 'btn btn-dark delete-submission') {
            if(confirm('confirm deletion of selected submission?')) {
                const id = e.target.getAttribute('row-id');

                // we delete the row and reload 
                fetch(`/demo_application/submission/delete/${id}`, { method: 'DELETE'}).then(res => window.location.reload());
            }
        }
    });
}
