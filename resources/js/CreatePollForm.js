import React, { useState } from 'react';
import { Form, Button, Container, Row, Col } from 'react-bootstrap';

const CreatePollForm = () => {
    // Define state variables using useState hook
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [endTime, setEndTime] = useState('');
    const [state, setState] = useState('live'); // Default state value

    // Event handler functions to update state variables
    const handleTitleChange = (event) => {
        setTitle(event.target.value);
    };

    const handleDescriptionChange = (event) => {
        setDescription(event.target.value);
    };

    const handleEndTimeChange = (event) => {
        setEndTime(event.target.value);
    };

    const handleStateChange = (event) => {
        setState(event.target.value);
    };

    // Function to handle form submission
    const handleSubmit = (event) => {
        event.preventDefault();
        // Logic to submit form data
    };

    return (
        <Container>
            <Row>
                <Col>
                    <h2>Create New Poll</h2>
                    <Form onSubmit={handleSubmit}>
                        <Form.Group controlId="title">
                            <Form.Label>Title</Form.Label>
                            <Form.Control type="text" placeholder="Enter title" value={title} onChange={handleTitleChange} />
                        </Form.Group>

                        <Form.Group controlId="description">
                            <Form.Label>Description</Form.Label>
                            <Form.Control as="textarea" rows={3} placeholder="Enter description" value={description} onChange={handleDescriptionChange} />
                        </Form.Group>

                        <Form.Group controlId="endTime">
                            <Form.Label>End Time (minutes)</Form.Label>
                            <Form.Control type="number" placeholder="Enter end time" value={endTime} onChange={handleEndTimeChange} />
                        </Form.Group>

                        <Form.Group controlId="state">
                            <Form.Label>State</Form.Label>
                            <Form.Control as="select" value={state} onChange={handleStateChange}>
                                <option value="live">Live</option>
                                <option value="draft">Draft</option>
                                <option value="closed">Closed</option>
                            </Form.Control>
                        </Form.Group>

                        <Button variant="primary" type="submit">
                            Create Poll
                        </Button>
                    </Form>
                </Col>
            </Row>
        </Container>
    );
};

export default CreatePollForm;
